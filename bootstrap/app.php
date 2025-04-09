<?php

use App\Exceptions\Handler as ExceptionHandler;
use App\Http\Middleware\EnsureAcceptsJson;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        then: function () {
            Route::middleware('api')
                ->prefix('admin-api')
                ->group(base_path('routes/admin.php'));

        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(EnsureAcceptsJson::class);
        $middleware->alias([
            'scopes' => \Laravel\Passport\Http\Middleware\CheckScopes::class,
            'scope' => \Laravel\Passport\Http\Middleware\CheckForAnyScope::class,
        ]);
    })
    ->withEvents()
    ->withExceptions(new ExceptionHandler)
    ->create();
