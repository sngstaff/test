<?php

namespace App\Http\Requests\Admin\ConfigurationOption;

use App\Enums\UserGateEnum;
use Illuminate\Foundation\Http\FormRequest;

final class SaveConfigurationOptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return authUser()->gate === UserGateEnum::ADMIN->value;
    }

    public function rules(): array
    {
        return [
            'configuration_id' => 'required|exists:configurations,id',
            'option_id' => 'required|exists:options,id'
        ];
    }

    public function attributes(): array
    {
        return [
            'configuration_id' => 'комплектация',
            'option_id' => 'опция'
        ];
    }
}
