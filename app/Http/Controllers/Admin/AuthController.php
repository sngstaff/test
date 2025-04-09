<?php

namespace App\Http\Controllers\Admin;

use App\Dto\Auth\LoginCredentialsDto;
use App\Enums\AuthTokenScopesEnum;
use App\Enums\UserGateEnum;
use App\Exceptions\ControlledException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\ResourcePack\Admin\UserPackResource;
use App\Services\Auth\AuthService;

final class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService)
    {
    }

    public function login(LoginRequest $request)
    {
        try {
            $user = $this->authService->login(
                LoginCredentialsDto::transform([
                    ...$request->validated(),
                    'gate' => UserGateEnum::ADMIN
                ])
            );

            return response()->json([
                'user'  => UserPackResource::pack($user),
                'token' => $user->createToken('admin.token', [AuthTokenScopesEnum::ADMIN->value])->accessToken
            ]);
        } catch (ControlledException $e) {
            return jsonResp()->error($e->getMessage());
        }
    }
}
