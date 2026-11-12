<?php

namespace App\Http\Controllers;

use App\Jobs\PerformTechBenchUpdate;
use App\Services\GitHubReleaseService;
use App\Services\InstallationManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Throwable;

class UpdateController extends Controller
{
    public function __invoke(
        Request $request,
        GitHubReleaseService $releases,
        InstallationManager $installation,
    ): JsonResponse {
        $validated = $request->validate([
            'version' => ['required', 'string', 'max:32'],
        ]);

        $version = $validated['version'];

        $release = $releases->validate($version);

        $previousVersion = $installation->currentVersion();

        if ($version === $previousVersion) {
            return response()->json([
                'message' => 'Tech Bench is already running this version.',
                'version' => $previousVersion,
            ], 422);
        }

        // Acquire a lock that remains held until the queued job finishes.
        $lock = Cache::lock('tech-bench-update', 3900);

        if (! $lock->get()) {
            return response()->json([
                'message' => 'Another update is already in progress.',
            ], 409);
        }

        $updateId = (string) Str::uuid();

        try {
            Cache::put(
                "tech-bench-update:{$updateId}",
                [
                    'id' => $updateId,
                    'status' => 'queued',
                    'previous_version' => $previousVersion,
                    'version' => $version,
                    'created_at' => now()->toIso8601String(),
                    'updated_at' => now()->toIso8601String(),
                ],
                now()->addHours(2),
            );

            Bus::dispatch(new PerformTechBenchUpdate(
                updateId: $updateId,
                version: $version,
                previousVersion: $previousVersion,
                release: [
                    'tag' => $release['tag_name'],
                    'name' => $release['name'] ?? null,
                    'published_at' => $release['published_at'] ?? null,
                    'html_url' => $release['html_url'] ?? null,
                ],
                lockOwner: $lock->owner(),
            ));

        } catch (Throwable $exception) {
            $lock->release();

            Cache::put(
                "tech-bench-update:{$updateId}",
                [
                    'id' => $updateId,
                    'status' => 'dispatch_failed',
                    'error' => $exception->getMessage(),
                    'updated_at' => now()->toIso8601String(),
                ],
                now()->addHours(2),
            );

            return response()->json([
                'message' => 'Unable to queue the update.',
                'error' => $exception->getMessage(),
            ], 503);
        }

        return response()->json([
            'message' => 'Update queued successfully.',
            'update_id' => $updateId,
            'version' => $version,
            'status' => 'queued',
        ], 202);
    }
}
