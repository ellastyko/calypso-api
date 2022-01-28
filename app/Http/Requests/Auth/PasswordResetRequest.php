<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => [
                'required',
                'min:8',
                'max:60',
                'confirmed',
                'regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/'
            ]
        ];
    }
}
