<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{

    /**
     * Register validation rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'surname' => ['string','max:50'],
            'email' => ['required','email', 'max:64'],
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
