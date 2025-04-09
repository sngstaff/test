<?php

namespace App\Listeners;

use App\Events\ForgetCacheCarsAfterChange;
use App\Services\CacheManager\CacheManagerService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CarSubscriber implements ShouldQueue
{
    use InteractsWithQueue;

    public $afterCommit = true;

    public function __construct(private readonly CacheManagerService $cacheManager)
    {
    }

    public function handleForgetCache(ForgetCacheCarsAfterChange $event)
    {
        $this->cacheManager->forget('cars.list');
    }

    public function subscribe(object $event): void
    {
        $event->listen(
            ForgetCacheCarsAfterChange::class,
            [self::class, 'handleForgetCache']
        );
    }
}
