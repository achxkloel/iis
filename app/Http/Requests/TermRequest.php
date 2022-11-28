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
            'description' => 'nullable',
            'type' => 'required',
            'score' => 'required',
            'duration_from' => 'nullable|required_with:duration_to|integer|between:8,20',
            'duration_to' => 'nullable|required_with:duration_from|integer|between:9,21|gt:duration_from',
            'day' => 'nullable|required_with_all:duration_from,duration_to|integer|between:1,5',
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
            'duration_from.required_with' => 'Prazdný začátek',
            'duration_to.required_with' => 'Prazdný konec',
            'day.required_with_all' => 'Prázdný den',
            'duration_from.integer' => 'Začátek by měl obsahovat celé číslo',
            'duration_to.integer' => 'Konec by měl obsahovat celé číslo',
            'duration_to.gt' => 'Konec je dříve než začátek',
            'day.integer' => 'Špatný den',
            'duration_from.between' => 'Spatný interval (8 - 20)',
            'duration_to.between' => 'Spatný interval (9 - 21)',
            'day.between' => 'Špatný den',
            'capacity.required' => 'Prazdný limit'
        ];
    }
}
