<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Passport::tokensCan([
            'admin' => 'Access to admin',
            'web' => 'Access to web',
        ]);
    }
}
