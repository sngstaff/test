<?php

namespace App\ResourcePack;

abstract class ResourcePackProvider
{
    public static function pack($data, ...$props)
    {
        return app(static::class)($data, ...$props);
    }
}
