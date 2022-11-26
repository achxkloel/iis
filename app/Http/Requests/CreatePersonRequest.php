<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePersonRequest extends FormRequest
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
            'login' => 'required|min:6|regex:/^[A-Za-z0-9_-]*$/i',
            'name' => 'required',
            'surname' => 'required',
            'role' => [
                'required',
                Rule::in(['guarantor', 'teacher', 'student'])
            ]
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
            'login.required' => 'Prazdný login',
            'login.min' => 'Přilíš kratký login (min: :min)',
            'login.regex' => 'Login obsahuje nepovolené znaky',
            'name.required' => 'Prazdné jméno',
            'surname.required' => 'Prazdné příjmení',
            'role.required' => 'Chybí role',
            'role.in' => 'Nedefinovaná role'
        ];
    }
}
