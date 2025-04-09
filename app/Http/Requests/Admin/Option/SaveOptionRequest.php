<?php

namespace App\Http\Requests\Admin\Option;

use App\Enums\UserGateEnum;
use Illuminate\Foundation\Http\FormRequest;

final class SaveOptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return authUser()->gate === UserGateEnum::ADMIN->value;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:150'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'название'
        ];
    }
}
