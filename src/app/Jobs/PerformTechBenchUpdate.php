<?php

namespace App\Jobs;

use App\Services\ComposeManager;
use App\Services\InstallationManager;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;
use Throwable;

class PerformTechBenchUpdate implements ShouldQueue
{
    use Queueable;

    public int $timeout = 3600;

    public int $tries = 1;

    public bool $failOnTimeout = true;

    public function __construct(
        public string $updateId,
        public string $version,
        public string $previousVersion,
        public array $release,
        public string $lockOwner,
    ) {
        $this->onQueue('docker-updates');
    }

    public function handle(
        InstallationManager $installation,
        ComposeManager $compose,
    ): void {
        $lock = Cache::restoreLock('tech-bench-update', $this->lockOwner);

        try {
            $this->setStatus('pulling');

            // Download the requested release images.
            $compose->pull($this->version);

            $this->setStatus('deploying');

            // Update the installation version and deploy.
            $installation->setVersion($this->version);

            try {
                $deployment = $compose->deploy();
            } catch (Throwable $updateException) {
                $this->setStatus('rolling_back', [
                    'update_error' => $updateException->getMessage(),
                ]);

                // Restore the previous version in the environment file.
                $installation->setVersion($this->previousVersion);

                $rollbackPullError = null;

                try {
                    $compose->pull($this->previousVersion);
                } catch (Throwable $pullException) {
                    $rollbackPullError = $pullException->getMessage();
                }

                // Attempt deployment even if pulling the old images failed.
                try {
                    $rollback = $compose->deploy();

                    $this->setStatus('rolled_back', [
                        'version' => $this->previousVersion,
                        'update_error' => $updateException->getMessage(),
                        'rollback_pull_warning' => $rollbackPullError,
                        'rollback' => $rollback,
                    ]);

                    return;
                } catch (Throwable $rollbackException) {
                    $this->setStatus('failed', [
                        'previous_version' => $this->previousVersion,
                        'requested_version' => $this->version,
                        'update_error' => $updateException->getMessage(),
                        'rollback_pull_error' => $rollbackPullError,
                        'rollback_error' => $rollbackException->getMessage(),
                    ]);

                    return;
                }
            }

            $this->setStatus('succeeded', [
                'previous_version' => $this->previousVersion,
                'version' => $this->version,
                'release' => $this->release,
                'deployment' => $deployment,
            ]);
        } catch (Throwable $exception) {
            $this->setStatus('failed', [
                'previous_version' => $this->previousVersion,
                'requested_version' => $this->version,
                'error' => $exception->getMessage(),
            ]);
        } finally {
            $lock->release();
        }
    }

    public function failed(Throwable $exception): void
    {
        try {
            $this->setStatus('failed', [
                'previous_version' => $this->previousVersion,
                'requested_version' => $this->version,
                'error' => $exception->getMessage(),
            ]);
        } finally {
            Cache::restoreLock('tech-bench-update', $this->lockOwner)
                ->release();
        }
    }

    private function setStatus(string $status, array $details = []): void
    {
        $key = "tech-bench-update:{$this->updateId}";

        $current = Cache::get($key, []);

        Cache::put($key, [
            ...$current,
            'status' => $status,
            'updated_at' => now()->toIso8601String(),
            ...$details,
        ], now()->addHours(2));
    }
}
