<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $provided = $request->bearerToken();
        $expected = config('docker-manager.api_key');

        if (
            ! $provided ||
            ! $expected ||
            ! hash_equals($expected, $provided)
        ) {
            return response()->json([
                'message' => 'Unauthenticated.',
            ], 401);
        }

        return $next($request);
    }
}
