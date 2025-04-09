<?php

namespace App\Services\CacheManager;

use Closure;
use Illuminate\Support\Facades\Cache;

final class CacheManagerService
{
    public function getOrRemember(string $key, int $ttl, Closure $callback)
    {
        if (Cache::has($this->getKey($key))) {
            return $this->get($key);
        }

        return $this->remember($key, $ttl, $callback);
    }

    public function put(string $key, mixed $data, int $ttl): void
    {
        Cache::put($this->getKey($key), $data, now()->addMinutes($ttl));
    }

    public function get(string $key): mixed
    {
        return Cache::get($this->getKey($key));
    }

    public function remember(string $key, int $ttl, Closure $callback)
    {
        return Cache::remember($this->getKey($key), now()->addMinutes($ttl), $callback);
    }

    public function forget(string $key): bool
    {
        return Cache::forget($this->getKey($key));
    }

    private function getKey(string $key): string
    {
        return "cache.manager.$key";
    }
}
