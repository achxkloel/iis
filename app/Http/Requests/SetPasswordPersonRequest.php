<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetPasswordPersonRequest extends FormRequest
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
            'newPassword' => 'required',
            'newPasswordCheck' => 'required|same:newPassword'
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
            'newPassword.required' => 'Prázdné nové heslo',
            'newPasswordCheck.required' => 'Prázdné heslo pro kontrolu',
            'newPasswordCheck.same' => 'Hesla se neshodují'
        ];
    }
}
