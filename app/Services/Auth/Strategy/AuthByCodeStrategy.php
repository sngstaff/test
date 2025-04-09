<?php

namespace App\Services\Auth\Strategy;

use App\Dto\Auth\LoginCredentialsDto;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Auth\Strategy\Interfaces\AuthStrategyInterface;
use App\Services\CodeGenerator\VerificationCodeGenerator;
use Illuminate\Validation\ValidationException;

final class AuthByCodeStrategy implements AuthStrategyInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly VerificationCodeGenerator $codeGenerator
    ) {
    }

    public function signin(LoginCredentialsDto $dto): User
    {
        if (! $this->codeGenerator->validateCode($dto->email, $dto->code)) {
            throw ValidationException::withMessages(['code' => 'Неверный код']);
        }

        $user = $this->userRepository->findByEmail($dto->email, gate: $dto->gate);

        if (! $user) {
            throw ValidationException::withMessages(['email' => 'Пользователь не найден']);
        }

        return $user;
    }
}
