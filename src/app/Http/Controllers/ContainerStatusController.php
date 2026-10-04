<?php

namespace App\Http\Controllers;

use App\Enums\ManagedContainer;
use App\Services\ContainerManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContainerStatusController extends Controller
{
    public function __construct(
        private readonly ContainerManager $containers,
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $containers = collect(
            ManagedContainer::cases()
        )->map(function (ManagedContainer $container) {
            $definition = config(
                "docker-manager.containers.{$container->value}"
            );

            try {
                $state = $this->containers->status($container);

                return [
                    'service' => $container->value,
                    'name' => $definition['display_name'],
                    'description' => $definition['description'],
                    'restartable' => $definition['restartable'],
                    'status' => $state['State']['Status'] ?? 'unknown',
                    'running' => $state['State']['Running'] ?? false,
                    'health' => $state['State']['Health']['Status'] ?? null,
                    'started_at' => $state['State']['StartedAt'] ?? null,
                ];
            } catch (\Throwable $e) {
                dd($e);

                return [
                    'service' => $container->value,
                    'name' => $definition['display_name'],
                    'description' => $definition['description'],
                    'restartable' => $definition['restartable'],
                    'status' => 'unavailable',
                    'running' => false,
                    'health' => null,
                    'started_at' => null,
                ];
            }
        });

        return response()->json([
            'containers' => $containers,
        ]);
    }
}
