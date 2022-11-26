<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TermRequest extends FormRequest
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
            'type' => 'required',
            'score' => 'required',
            'date-from' => 'required',
            'date-to' => 'required',
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
            'type.required' => 'Prazdný typ',
            'score.required' => 'Prazdné skóre',
            'date-from.required' => 'Prazdné datum',
            'date-to.required' => 'Prazdné datum',
            'capacity.required' => 'Prazdný limit'
        ];
    }
}
