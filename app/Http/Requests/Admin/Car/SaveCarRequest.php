<?php

namespace App\Http\Requests\Admin\Car;

use App\Enums\UserGateEnum;
use Illuminate\Foundation\Http\FormRequest;

final class SaveCarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return authUser()->gate === UserGateEnum::ADMIN->value;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'название'
        ];
    }
}
