<?php

namespace App\Actions;

use App\Events\ForgotPassword;
use App\Models\User;
use Carbon\Carbon;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Support\Facades\DB;

class ForgotPasswordAction
{
    public function handle($email) {

        $user = User::where('email', $email)->firstOrFail();

        $token = Str::random(60);

        DB::table('password_resets')->insert([
            'email' => $user->email,
            'link' => $token,
            'created_at' => Carbon::now()
        ]);

        $link = config('APP_URL').'?link='.$token;

        event(new ForgotPassword($user, $link));
    }
}
