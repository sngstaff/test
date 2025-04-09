<?php

namespace App\Services\Auth\Strategy\Interfaces;

use App\Dto\Auth\LoginCredentialsDto;
use App\Models\User;

interface AuthStrategyInterface
{
    public function signin(LoginCredentialsDto $dto): User;
}
