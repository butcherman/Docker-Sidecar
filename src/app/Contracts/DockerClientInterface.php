<?php

namespace App\Contracts;

use App\Enums\ManagedContainer;

interface DockerClientInterface
{
    public function inspect(ManagedContainer $container): array;

    public function list(): array;

    public function restart(ManagedContainer $container, int $timeout = 10): void;
}
