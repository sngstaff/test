<?php

namespace App\Repositories\Interfaces;

use App\Enums\UserGateEnum;
use App\Models\User;

/**
 * @see \App\Repositories\UserRepository
 */
interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function findByEmail(string $email, ?UserGateEnum $gate = null): ?User;
}
