<?php

namespace App\Services\Auth\Strategy;

use App\Dto\Auth\LoginCredentialsDto;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Auth\Strategy\Interfaces\AuthStrategyInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

final class AuthByPasswordStrategy implements AuthStrategyInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    public function signin(LoginCredentialsDto $dto): User
    {
        $user = $this->userRepository->findByEmail($dto->email, gate: $dto->gate);

        if (!$user) {
            throw ValidationException::withMessages(['email' => 'Пользователь не найден']);
        }

        if (!Hash::check($dto->password, $user->password)) {
            throw ValidationException::withMessages(['password' => 'Неверный пароль']);
        }

        return $user;
    }
}
