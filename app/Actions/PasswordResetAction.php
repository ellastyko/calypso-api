<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetAction
{
    public function handle($data) {

        $user = User::where('email', $data['email'])->first();

        $user->forceFill([
            'password' => Hash::make($data['password'])
        ])->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));
    }
}
