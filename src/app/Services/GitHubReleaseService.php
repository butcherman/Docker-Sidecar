<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class GitHubReleaseService
{
    private const API_URL = 'https://api.github.com/repos/butcherman/Tech_Bench/releases/tags/';

    public function validate(string $version): array
    {
        if (! preg_match('/^\d+\.\d+\.\d+$/', $version)) {
            throw ValidationException::withMessages([
                'version' => 'The version must use X.Y.Z format.',
            ]);
        }

        $tag = "v{$version}";

        $response = Http::acceptJson()
            ->withHeaders([
                'User-Agent' => 'Tech-Bench-Docker-Sidecar',
            ])
            ->timeout(10)
            ->get(self::API_URL.$tag);

        if ($response->status() === 404) {
            throw ValidationException::withMessages([
                'version' => "Release {$tag} was not found.",
            ]);
        }

        if (! $response->successful()) {
            throw new \RuntimeException(
                'Unable to verify the GitHub release. HTTP status: '
                .$response->status()
            );
        }

        $release = $response->json();

        if (
            ! is_array($release)
            || ($release['tag_name'] ?? null) !== $tag
            || ($release['draft'] ?? true)
            || ($release['prerelease'] ?? true)
        ) {
            throw ValidationException::withMessages([
                'version' => "Release {$tag} is not a published stable release.",
            ]);
        }

        return $release;
    }
}
