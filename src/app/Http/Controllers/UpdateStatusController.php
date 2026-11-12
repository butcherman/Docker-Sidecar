<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class UpdateStatusController extends Controller
{
    public function __invoke(string $updateId): JsonResponse
    {
        if (! preg_match(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i',
            $updateId
        )) {
            return response()->json([
                'message' => 'Invalid update ID.',
            ], 422);
        }

        $status = Cache::get("tech-bench-update:{$updateId}");

        if (! is_array($status)) {
            return response()->json([
                'message' => 'Update not found.',
            ], 404);
        }

        return response()->json($status);
    }
}
