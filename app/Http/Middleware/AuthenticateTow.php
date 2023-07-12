<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateTow
{
    public function handle($request, Closure $next)
    {
        if (!$request->header('Authorization')) {
            return response()->json(['error' => 'Authorization header is missing.'], 401);
        }

        return $next($request);
    }
}