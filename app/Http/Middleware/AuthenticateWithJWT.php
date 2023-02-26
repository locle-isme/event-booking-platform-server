<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class AuthenticateWithJWT
{
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (\Throwable $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json(['message' => 'Token is Invalid'], 400);
            }
            if ($e instanceof TokenExpiredException) {
                return response()->json(['message' => 'Token is Expired'], 400);
            }
            return response()->json(['message' => 'Unauthorized'], 400);
        }
        return $next($request);
    }
}
