<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

final class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'nullable|string',
            'code' => 'nullable|string'
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'почта',
            'password' => 'пароль',
            'code' => 'код подтверждения'
        ];
    }
}
