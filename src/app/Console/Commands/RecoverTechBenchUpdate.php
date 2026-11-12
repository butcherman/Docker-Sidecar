<?php

namespace App\Console\Commands;

use App\Services\ComposeManager;
use App\Services\InstallationManager;
use App\Services\UpdateJournal;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Throwable;

#[Signature('docker-manager:recover')]
#[Description('Recover an interrupted Tech Bench update')]
class RecoverTechBenchUpdate extends Command
{
    public function handle(
        UpdateJournal $journal,
        InstallationManager $installation,
        ComposeManager $compose,
    ): int {
        // No journal means there is no interrupted update to recover.
        $record = $journal->read();

        if ($record === null) {
            $this->info('No interrupted update found.');

            return self::SUCCESS;
        }

        // Refuse to recover if another update currently owns the lock.
        $lock = Cache::lock('tech-bench-update', 3900);

        if (! $lock->get()) {
            $this->error('Another update is in progress. Recovery cannot start.');

            return self::FAILURE;
        }

        try {
            // Re-read the journal after acquiring the lock.
            $record = $journal->read();

            if ($record === null) {
                $this->info('The update journal has already been cleared.');

                return self::SUCCESS;
            }

            $this->warn('An interrupted update was found.');
            $this->line('Journal status: '.($record['status'] ?? 'unknown'));
            $this->line('Previous version: '.($record['previous_version'] ?? 'unknown'));
            $this->line('Requested version: '.($record['requested_version'] ?? 'unknown'));

            $status = $record['status'] ?? null;

            if (! is_string($status)) {
                $this->error('The update journal has no valid status.');

                return self::FAILURE;
            }

            $previousVersion = $record['previous_version'] ?? null;
            $requestedVersion = $record['requested_version'] ?? null;

            if (
                ! is_string($previousVersion) ||
                ! preg_match('/^\d+\.\d+\.\d+$/', $previousVersion) ||
                ! is_string($requestedVersion) ||
                ! preg_match('/^\d+\.\d+\.\d+$/', $requestedVersion)
            ) {
                $this->error('The update journal contains invalid version information.');

                return self::FAILURE;
            }

            $this->warn('An interrupted update was found.');
            $this->line("Journal status: {$status}");
            $this->line("Previous version: {$previousVersion}");
            $this->line("Requested version: {$requestedVersion}");

            $rollbackStatuses = [
                'switching_version',
                'version_switched',
                'deploying',
                'rolling_back',
                'rollback_version_switched',
                'recovery_required',
                'recovering',
                'completed',
                'rolled_back',
            ];

            $safeToClearStatuses = [
                'starting',
                'pulling',
                'images_pulled',
            ];

            if (in_array($status, $safeToClearStatuses, true)) {
                $journal->clear();

                $this->info('The installation version was not switched. The journal has been cleared.');

                return self::SUCCESS;
            }

            // A completed update may only need its journal cleared.
            if (in_array($status, ['completed', 'rolled_back'], true)) {
                $expectedVersion = $status === 'completed'
                    ? $requestedVersion
                    : $previousVersion;

                try {
                    if ($installation->currentVersion() === $expectedVersion) {
                        $compose->status();

                        $journal->clear();

                        $this->info(
                            "Version {$expectedVersion} is running and healthy. The journal has been cleared."
                        );

                        return self::SUCCESS;
                    }

                    $this->warn(
                        'The installed version does not match the journal. A rollback will be attempted.'
                    );
                } catch (Throwable $exception) {
                    $this->warn(
                        'Deployment verification failed. A rollback will be attempted: '
                        .$exception->getMessage()
                    );
                }
            }

            if (! in_array($status, $rollbackStatuses, true)) {
                $this->error("Journal status '{$status}' requires manual investigation.");

                return self::FAILURE;
            }

            $this->warn("Restoring Tech Bench to version {$previousVersion}...");

            $journal->write([
                ...$record,
                'status' => 'recovering',
                'updated_at' => now()->toIso8601String(),
            ]);

            try {
                // Restore the previous version in the installation environment.
                $installation->setVersion($previousVersion);

                $journal->write([
                    ...$record,
                    'status' => 'rollback_version_switched',
                    'updated_at' => now()->toIso8601String(),
                ]);

                // Pull the previous release images.
                $pullWarning = null;

                try {
                    $compose->pull($previousVersion);
                } catch (Throwable $exception) {
                    $pullWarning = $exception->getMessage();

                    $this->warn('Unable to pull the previous images. Trying the locally cached images.');
                }

                // Deploy and verify the previous version.
                $deployment = $compose->deploy();

                $journal->clear();

                $this->info("Tech Bench was successfully restored to version {$previousVersion}.");

                if ($pullWarning !== null) {
                    $this->warn("Image pull warning: {$pullWarning}");
                }

                return self::SUCCESS;
            } catch (Throwable $exception) {
                $journal->write([
                    ...$record,
                    'status' => 'recovery_required',
                    'recovery_error' => $exception->getMessage(),
                    'updated_at' => now()->toIso8601String(),
                ]);

                $this->error('Recovery failed: '.$exception->getMessage());

                return self::FAILURE;
            }
        } finally {
            $lock->release();
        }
    }
}
