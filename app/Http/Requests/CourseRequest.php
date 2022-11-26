<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'name' => 'required',
            'shortcut' => 'required',
            'description' => 'required',
            'capacity' => 'required'
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
            'name.required' => 'Prazdné jméno',
            'shortcut.required' => 'Prazdná zkratka',
            'description.required' => 'Prazdný popis',
            'capacity.required' => 'Prazdný limit'
        ];
    }
}
