<?php

namespace App\Repositories;

use App\Enums\UserGateEnum;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findByEmail(string $email, ?UserGateEnum $gate = null): ?User
    {
        return $this->model->where('email', $email)
            ->when($gate, fn ($q) => $q->whereGate($gate))
            ->first();
    }
}
