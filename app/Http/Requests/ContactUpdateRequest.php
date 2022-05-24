<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class ContactUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => 'sometimes|required|string|max:255',
            'middle_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:255|phone:RU',
            'gender' => [
                'sometimes',
                'required',
                'int',
                new EnumValue(Gender::class, false),
            ],
            "favorite" => 'sometimes|bool'
        ];
    }
}
