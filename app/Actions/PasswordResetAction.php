<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class PasswordResetAction
 */
class PasswordResetAction
{
    /**
     * @param $data
     * @return void
     */
    public function handle($data) {

        $reset = DB::table('password_resets')->where('email', $data['token'])->first();

        $user = User::where('email', $reset->email)->first();

        $user->forceFill([
            'password' => Hash::make($data['password'])
        ])->setRememberToken(Str::random(60));

        $user->save();
        $reset->delete();

        event(new PasswordReset($user));
    }
}
