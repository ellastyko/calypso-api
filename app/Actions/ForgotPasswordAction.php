<?php

namespace App\Actions;

use App\Events\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Response;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Support\Facades\DB;

/**
 * Class ForgotPasswordAction
 */
class ForgotPasswordAction
{
    /**
     * @param array $data
     */
    public function handle(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        DB::table('password_resets')->insert([
            'email' => $user->email,
            'link' => $token = Str::random(60)
        ]);

        $link = config('app.url') . '/password-reset?token=' . $token;

        event(new ForgotPassword($user, $link));
    }
}
