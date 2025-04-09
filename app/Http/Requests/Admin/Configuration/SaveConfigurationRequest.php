<?php

namespace App\Http\Requests\Admin\Configuration;

use App\Enums\UserGateEnum;
use Illuminate\Foundation\Http\FormRequest;

final class SaveConfigurationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return authUser()->gate === UserGateEnum::ADMIN->value;
    }

    public function rules(): array
    {
        return [
            'car_id' => 'required|exists:cars,id',
            'name' => 'required|string|max:150'
        ];
    }

    public function attributes(): array
    {
        return [
            'car_id' => 'автомобиль',
            'name' => 'название'
        ];
    }
}
