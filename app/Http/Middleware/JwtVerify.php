<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class JwtVerify
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Just validate token (no login logic needed)
            JWTAuth::parseToken()->authenticate();

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Invalid or missing token'
            ], 401);
        }

        return $next($request);
    }
}