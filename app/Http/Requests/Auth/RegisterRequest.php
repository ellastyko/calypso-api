<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

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
            'name' => ['required', 'string', 'max:50'],
            'surname' => ['string','max:50'],
            'email' => ['required','email','unique:users,email','max:64'],
            'password' => Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()
        ];
    }
}
