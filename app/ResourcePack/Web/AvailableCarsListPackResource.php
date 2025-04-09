<?php

namespace App\ResourcePack\Web;

use App\ResourcePack\ResourcePackProvider;

final class AvailableCarsListPackResource extends ResourcePackProvider
{
    public function __invoke(mixed $data)
    {
        $collect = collect();

        foreach ($data as $item) {
            $collect->push([
                'id' => $item->id,
                'name' => $item->name,
                'configurations' => ConfigurationListPackResource::pack($item->configurations)
            ]);
        }

        return $collect;
    }
}
