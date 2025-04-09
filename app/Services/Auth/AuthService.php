<?php

namespace App\Services\Auth;

use App\Dto\Auth\LoginCredentialsDto;
use App\Services\Auth\Strategy\AuthByCodeStrategy;
use App\Services\Auth\Strategy\AuthByPasswordStrategy;
use App\Services\Auth\Strategy\Interfaces\AuthStrategyInterface;

final class AuthService
{
    protected AuthStrategyInterface $strategy;

    protected $singinStategyTypes = [
        'by_code'     => AuthByCodeStrategy::class,
        'by_password' => AuthByPasswordStrategy::class
    ];

    public function login(LoginCredentialsDto $dto)
    {
        $this->detectAuthStrategy($dto);

        return $this->strategy->signin($dto);
    }

    private function detectAuthStrategy(LoginCredentialsDto $dto)
    {
        $strategy = $dto->code ? 'by_code' : 'by_password';

        $this->strategy = app($this->singinStategyTypes[$strategy]);
    }
}
