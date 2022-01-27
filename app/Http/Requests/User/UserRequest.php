<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'name' => ['string', 'max:25'],
            'surname' => ['string','max:25'],
            'email' => ['string','email', 'max:64'],
            'password' => ['string','min:8', 'max:64', 'confirmed', 'regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/']
        ];
    }
}
