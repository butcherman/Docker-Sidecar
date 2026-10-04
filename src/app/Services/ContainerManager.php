<?php

namespace App\Services;

use App\Contracts\DockerClientInterface;
use App\Enums\ManagedContainer;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class ContainerManager
{
    public function __construct(private readonly DockerClientInterface $docker) {}

    public function restart(ManagedContainer $container): void
    {
        $definition = config(
            "docker-manager.containers.{$container->value}"
        );

        if (! $definition) {
            throw new RuntimeException(
                "Unknown managed container: {$container->value}"
            );
        }

        if (! $definition['restartable']) {
            throw new RuntimeException(
                "{$definition['display_name']} cannot be restarted."
            );
        }

        $this->docker->restart($container);
    }

    /**
     * @return array<string, mixed>
     */
    public function status(ManagedContainer $container): array
    {
        Log::debug('Checking status for container');

        return $this->docker->inspect($container);
    }
}
