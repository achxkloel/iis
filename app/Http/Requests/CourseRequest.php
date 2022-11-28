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
            'description' => 'nullable',
            'capacity' => 'required|integer|min:1',
            'price' => 'nullable|integer|min:0',
            'date_from' => 'required|date_format:d.m.Y',
            'date_to' => 'required|date_format:d.m.Y'
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
            'capacity.required' => 'Prazdný limit',
            'capacity.integer' => 'Limit má obsahovat pouze celé číslo',
            'capacity.min' => 'Minmální limit: :min',
            'price.integer' => 'Cena má obsahovat pouze celé číslo',
            'price.min' => 'Cena může být pouze kladná',
            'date_from.required' => 'Prazdný začatek',
            'date_to.required' => 'Prazdný konec',
            'date_from.date_format' => 'Špatný formát',
            'date_to.date_format' => 'Špatný formát',
        ];
    }
}
