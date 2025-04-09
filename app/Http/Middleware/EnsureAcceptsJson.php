<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EnsureAcceptsJson
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->expectsJson() && !Str::startsWith($request->getRequestUri(), '/swagger')) {
            return response()->json(['message' => 'ACCEPT_JSON_ERROR'], 400);
        }

        return $next($request);
    }
}
