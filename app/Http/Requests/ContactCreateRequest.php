<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class ContactCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|phone:RU',
            'gender' => [
                'required',
                'int',
                new EnumValue(Gender::class, false),
            ],
        ];
    }
}
