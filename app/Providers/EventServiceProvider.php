<?php

namespace App\Providers;

use App\Listeners\CarSubscriber;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $subscribe = [
        CarSubscriber::class
    ];
}
