<?php

namespace App\ResourcePack\Admin;

use App\Models\User;
use App\ResourcePack\ResourcePackProvider;

final class UserPackResource extends ResourcePackProvider
{
    public function __invoke(User $data)
    {
        return [
            'id'   => $data->id,
            'name' => $data->name,
            'email' => $data->email,
            'gate' => $data->gate,
        ];
    }
}
