<?php

namespace App\Jobs;

use App\Services\ComposeManager;
use App\Services\InstallationManager;
use App\Services\UpdateJournal;
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
        UpdateJournal $journal,
    ): void {
        $lock = Cache::restoreLock('tech-bench-update', $this->lockOwner);

        $journalStarted = false;
        $versionSwitched = false;

        try {
            // Never overwrite an existing recovery journal.
            if ($journal->read() !== null) {
                throw new \RuntimeException(
                    'An existing update journal requires recovery before another update can run.'
                );
            }

            // Record the operation before making any changes.
            $journal->write([
                'id' => $this->updateId,
                'status' => 'starting',
                'previous_version' => $this->previousVersion,
                'requested_version' => $this->version,
                'created_at' => now()->toIso8601String(),
                'updated_at' => now()->toIso8601String(),
            ]);

            $journalStarted = true;

            $this->setStatus('pulling');

            $journal->write([
                'id' => $this->updateId,
                'status' => 'pulling',
                'previous_version' => $this->previousVersion,
                'requested_version' => $this->version,
                'updated_at' => now()->toIso8601String(),
            ]);

            // Download the requested release images.
            $compose->pull($this->version);

            $journal->write([
                'id' => $this->updateId,
                'status' => 'images_pulled',
                'previous_version' => $this->previousVersion,
                'requested_version' => $this->version,
                'updated_at' => now()->toIso8601String(),
            ]);

            $this->setStatus('deploying');

            $journal->write([
                'id' => $this->updateId,
                'status' => 'switching_version',
                'previous_version' => $this->previousVersion,
                'requested_version' => $this->version,
                'updated_at' => now()->toIso8601String(),
            ]);

            // Switch the installation to the requested version.
            $installation->setVersion($this->version);
            $versionSwitched = true;

            $journal->write([
                'id' => $this->updateId,
                'status' => 'version_switched',
                'previous_version' => $this->previousVersion,
                'requested_version' => $this->version,
                'updated_at' => now()->toIso8601String(),
            ]);

            $journal->write([
                'id' => $this->updateId,
                'status' => 'deploying',
                'previous_version' => $this->previousVersion,
                'requested_version' => $this->version,
                'updated_at' => now()->toIso8601String(),
            ]);

            // Deploy and verify all five managed services.
            $deployment = $compose->deploy();

            $this->setStatus('succeeded', [
                'previous_version' => $this->previousVersion,
                'version' => $this->version,
                'release' => $this->release,
                'deployment' => $deployment,
            ]);

            $journal->write([
                'id' => $this->updateId,
                'status' => 'completed',
                'previous_version' => $this->previousVersion,
                'requested_version' => $this->version,
                'updated_at' => now()->toIso8601String(),
            ]);

            $journal->clear();
        } catch (Throwable $exception) {
            if ($journalStarted && $versionSwitched) {
                // Every failure after switching versions uses this
                // single rollback path.
                $this->setStatus('rolling_back', [
                    'update_error' => $exception->getMessage(),
                ]);

                $journal->write([
                    'id' => $this->updateId,
                    'status' => 'rolling_back',
                    'previous_version' => $this->previousVersion,
                    'requested_version' => $this->version,
                    'update_error' => $exception->getMessage(),
                    'updated_at' => now()->toIso8601String(),
                ]);

                $rollbackPullError = null;

                try {
                    // Restore the previous version in the environment.
                    $installation->setVersion($this->previousVersion);

                    $journal->write([
                        'id' => $this->updateId,
                        'status' => 'rollback_version_switched',
                        'previous_version' => $this->previousVersion,
                        'requested_version' => $this->version,
                        'updated_at' => now()->toIso8601String(),
                    ]);

                    // Try to download the previous release images.
                    try {
                        $compose->pull($this->previousVersion);
                    } catch (Throwable $pullException) {
                        $rollbackPullError = $pullException->getMessage();
                    }

                    // Attempt deployment even if pulling old images failed.
                    $rollback = $compose->deploy();

                    $this->setStatus('rolled_back', [
                        'version' => $this->previousVersion,
                        'update_error' => $exception->getMessage(),
                        'rollback_pull_warning' => $rollbackPullError,
                        'rollback' => $rollback,
                    ]);

                    $journal->write([
                        'id' => $this->updateId,
                        'status' => 'rolled_back',
                        'previous_version' => $this->previousVersion,
                        'requested_version' => $this->version,
                        'updated_at' => now()->toIso8601String(),
                    ]);

                    $journal->clear();
                } catch (Throwable $rollbackException) {
                    $this->setStatus('failed', [
                        'previous_version' => $this->previousVersion,
                        'requested_version' => $this->version,
                        'update_error' => $exception->getMessage(),
                        'rollback_pull_error' => $rollbackPullError,
                        'rollback_error' => $rollbackException->getMessage(),
                    ]);

                    // Keep this journal for startup recovery.
                    $journal->write([
                        'id' => $this->updateId,
                        'status' => 'recovery_required',
                        'previous_version' => $this->previousVersion,
                        'requested_version' => $this->version,
                        'update_error' => $exception->getMessage(),
                        'rollback_pull_error' => $rollbackPullError,
                        'rollback_error' => $rollbackException->getMessage(),
                        'updated_at' => now()->toIso8601String(),
                    ]);
                }
            } else {
                // The installation version was not switched, so no
                // deployment rollback is necessary.
                $this->setStatus('failed', [
                    'previous_version' => $this->previousVersion,
                    'requested_version' => $this->version,
                    'error' => $exception->getMessage(),
                ]);

                if ($journalStarted) {
                    $journal->clear();
                }
            }
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
