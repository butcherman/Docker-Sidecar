<?php

namespace App\Services;

use App\Contracts\DockerClientInterface;
use App\Enums\ManagedContainer;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class DockerClient implements DockerClientInterface
{
    public function __construct(
        private readonly string $socket,
        private readonly string $apiVersion,
    ) {}

    public function inspect(ManagedContainer $container): array
    {
        return $this->request(
            'GET',
            "/containers/{$this->containerName($container)}/json",
        );
    }

    public function list(): array
    {
        return $this->request(
            'GET',
            '/containers/json?all=true',
        );
    }

    public function restart(ManagedContainer $container, int $timeout = 10): void
    {
        $this->request(
            'POST',
            sprintf(
                '/containers/%s/restart?t=%d',
                $this->containerName($container),
                $timeout,
            ),
        );
    }

    private function containerName(ManagedContainer $container): string
    {
        $name = config(
            "docker-manager.containers.{$container->value}.name"
        );

        if (! $name) {
            throw new RuntimeException(
                "No Docker container configured for {$container->value}."
            );
        }

        return $name;
    }

    private function request(string $method, string $path): array
    {
        Log::debug('Client request being made', [
            'method' => $method,
            'path' => $path,
        ]);

        $url = sprintf(
            'http://localhost/%s%s',
            $this->apiVersion,
            $path,
        );

        $curl = curl_init($url);

        if ($curl === false) {
            throw new RuntimeException('Unable to initialize cURL.');
        }

        curl_setopt_array($curl, [
            CURLOPT_UNIX_SOCKET_PATH => $this->socket,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
        ]);

        $body = curl_exec($curl);

        if ($body === false) {
            $error = curl_error($curl);

            throw new RuntimeException(
                "Docker API request failed: {$error}"
            );
        }

        $status = curl_getinfo(
            $curl,
            CURLINFO_HTTP_CODE
        );

        if ($status < 200 || $status >= 300) {
            throw new RuntimeException(
                "Docker API returned HTTP {$status}: {$body}"
            );
        }

        if ($body === '') {
            return [];
        }

        $decoded = json_decode(
            $body,
            true,
            flags: JSON_THROW_ON_ERROR,
        );

        return is_array($decoded)
            ? $decoded
            : [];
    }
}
