<?php

namespace App\ResourcePack\Web;

use App\ResourcePack\ResourcePackProvider;

final class ConfigurationListPackResource extends ResourcePackProvider
{
    public function __invoke(mixed $data)
    {
        $collect = collect();

        foreach ($data as $item) {
            $collect->push([
                'id' => $item->id,
                'name' => $item->name,
                'options' => $item->options?->pluck('name'),
                'current_price' => $item->price->price
            ]);
        }

        return $collect;
    }
}
