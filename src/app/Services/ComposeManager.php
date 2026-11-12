<?php

namespace App\Services;

use Illuminate\Support\Facades\Process;
use RuntimeException;

class ComposeManager
{
    private const SERVICES = [
        'tech_bench',
        'reverb',
        'horizon',
        'scheduler',
        'nginx',
    ];

    private string $projectName;

    private string $composeDirectory;

    public function __construct()
    {
        $projectName = config('docker-manager.installation.project_name');
        $composeDirectory = config('docker-manager.installation.compose_directory');

        if (! is_string($projectName) || $projectName === '') {
            throw new RuntimeException(
                'Docker Compose project name is not configured.'
            );
        }

        if (! is_string($composeDirectory) || $composeDirectory === '') {
            throw new RuntimeException(
                'Docker Compose directory is not configured.'
            );
        }

        $this->projectName = $projectName;
        $this->composeDirectory = $composeDirectory;
    }

    private function command(): array
    {
        return [
            'docker',
            'compose',
            '-p',
            $this->projectName,
            '--project-directory',
            $this->composeDirectory,
            '-f',
            $this->composeDirectory.'/docker-compose.yml',
        ];
    }

    private function services(array $services): array
    {
        if ($services === []) {
            throw new RuntimeException(
                'At least one service must be specified.'
            );
        }

        foreach ($services as $service) {
            if (! in_array($service, self::SERVICES, true)) {
                throw new RuntimeException(
                    "Service '{$service}' is not allowed."
                );
            }
        }

        return array_values(array_unique($services));
    }

    private function run(array $arguments, array $environment = []): string
    {
        $result = Process::timeout(600)
            ->path($this->composeDirectory)
            ->env($environment)
            ->run([
                ...$this->command(),
                ...$arguments,
            ]);

        if ($result->failed()) {
            throw new RuntimeException(
                sprintf(
                    "Docker Compose command failed (exit code %d):\n%s",
                    $result->exitCode(),
                    trim($result->errorOutput() ?: $result->output()),
                )
            );
        }

        return trim($result->output());
    }

    public function pull(string $version): string
    {
        if (! preg_match('/^\d+\.\d+\.\d+$/', $version)) {
            throw new RuntimeException(
                'The version must use X.Y.Z format.'
            );
        }

        return $this->run(
            [
                'pull',
                ...$this->services(self::SERVICES),
            ],
            [
                'APP_VERSION' => $version,
            ],
        );
    }

    public function status(int $timeout = 180): array
    {
        if ($timeout < 1 || $timeout > 600) {
            throw new RuntimeException(
                'Status timeout must be between 1 and 600 seconds.'
            );
        }

        $deadline = microtime(true) + $timeout;

        do {
            $output = $this->run([
                'ps',
                '--format',
                'json',
            ]);

            $statuses = [];
            $failures = [];

            foreach (preg_split('/\r?\n/', $output, -1, PREG_SPLIT_NO_EMPTY) as $line) {
                $container = json_decode($line, true);

                if (! is_array($container) || ! isset($container['Service'], $container['State'])) {
                    throw new RuntimeException(
                        'Unable to parse Docker Compose container status.'
                    );
                }

                $service = $container['Service'];

                if (! in_array($service, self::SERVICES, true)) {
                    continue;
                }

                $state = $container['State'];
                $health = $container['Health'] ?? '';

                $statuses[$service][] = [
                    'state' => $state,
                    'health' => $health ?: null,
                ];

                if ($state !== 'running') {
                    $failures[] = "{$service} is not running (state: {$state}).";
                } elseif ($health !== '' && $health !== 'healthy') {
                    $failures[] = "{$service} is not healthy (health: {$health}).";
                }
            }

            foreach (self::SERVICES as $service) {
                if (! isset($statuses[$service])) {
                    $failures[] = "{$service} container was not found.";
                }
            }

            if ($failures === []) {
                return $statuses;
            }

            if (microtime(true) >= $deadline) {
                throw new RuntimeException(
                    "Docker Compose deployment verification timed out:\n".
                    implode("\n", $failures)
                );
            }

            usleep(2_000_000);
        } while (true);
    }

    public function deploy(): array
    {
        $output = $this->run([
            'up',
            '-d',
            '--no-deps',
            '--no-build',
            '--pull',
            'never',
            ...$this->services(self::SERVICES),
        ]);

        return [
            'output' => $output,
            'status' => $this->status(),
        ];
    }
}
