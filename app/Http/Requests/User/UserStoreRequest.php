<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends RegisterRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['string', 'max:50'],
            'surname' => ['string','max:50'],
            'email' => ['string','email', 'max:64'],
            'password' => [
                'string',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ]
        ];
    }
}
