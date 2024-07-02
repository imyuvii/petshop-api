<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JWTAuth;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (! $user) {
                return response()->json(['message' => 'User not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Token is invalid'], 401);
        }

        return $next($request);
    }
}
