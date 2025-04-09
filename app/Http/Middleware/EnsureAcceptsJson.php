<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAcceptsJson
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->expectsJson()) {
            return response()->json(['message' => 'ACCEPT_JSON_ERROR'], 400);
        }

        return $next($request);
    }
}
