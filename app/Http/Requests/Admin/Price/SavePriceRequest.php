<?php

namespace App\Http\Requests\Admin\Price;

use App\Enums\UserGateEnum;
use Illuminate\Foundation\Http\FormRequest;

final class SavePriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return authUser()->gate === UserGateEnum::ADMIN->value;
    }

    public function rules(): array
    {
        return [
            'configuration_id' => 'required|exists:configurations,id',
            'price' => 'required|integer',
            'start_date' => 'required|date|date_format:Y-m-d H:i:s',
            'end_date' => 'required|date|date_format:Y-m-d H:i:s|after:start_date',
        ];
    }

    public function attributes(): array
    {
        return [
            'configuration_id' => 'конфигурация',
            'name' => 'название',
            'start_date' => 'дата начала',
            'end_date' => 'дата окончания'
        ];
    }
}
