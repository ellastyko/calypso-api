<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Auth\RegisterRequest;

class UserStoreRequest extends RegisterRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            //
        ]);
    }
}
