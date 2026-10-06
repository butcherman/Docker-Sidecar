<?php

namespace App\Http\Controllers;

use App\Enums\ManagedContainer;
use App\Services\ContainerManager;

class ContainerRestartController extends Controller
{
    public function __construct(
        private readonly ContainerManager $containers,
    ) {}

    /**
     * Reboot a Docker Container
     */
    public function __invoke(ManagedContainer $container)
    {
        $this->containers->restart($container);
    }
}
