<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'birth_date' => 'date_format:d.m.Y|nullable',
            'address' => 'nullable',
            'phone_number' => 'nullable|regex:/^(\+420)? ?[1-9][0-9]{2} ?[0-9]{3} ?[0-9]{3}$/i',
            'email' => 'email:rfc,dns|nullable'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'birth_date.date_format' => 'Špatný formát',
            'phone_number.regex' => 'Špatné telefonní číslo',
            'email.email' => 'Špatný email'
        ];
    }
}
