<?php

namespace App\Actions;

use App\Events\ForgotPassword;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class UserRegisterAction
{
    public function handle($data) {

        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        event(new Registered($user));
        return $user;
    }
}
