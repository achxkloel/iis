<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateClassRequest extends FormRequest
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
            'type' => [
                'required',
                Rule::in(['lecture_room', 'lab', 'computer_lab'])
            ],
            'capacity' => 'required|integer|min:1',
            'floor' => 'integer|nullable'
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
            'name.required' => 'Prázdné jmnéno',
            'type.required' => 'Prázdný typ',
            'type.in' => 'Nedefinovaný typ',
            'capacity.required' => 'Prázdný limit',
            'capacity.integer' => 'Počet míst může obsahovat pouze celé číslo',
            'capacity.min' => 'Špatný počet míst (min: :min)',
            'floor.integer' => 'Patro může obsahovat pouze celé číslo'
        ];
    }
}
