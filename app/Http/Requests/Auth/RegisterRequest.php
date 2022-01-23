<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:25'],
            'surname' => ['string','max:25'],
            'email' => ['required','email','unique:users,email','max:64'],
            'password' => ['required','min:8', 'max:40', 'confirmed', 'regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/']
        ];
    }
}
