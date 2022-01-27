<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class LoginAction
{

    /**
     * @param $request
     * @return void
     */
    public function handle($request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'message' => trans('auth.failed')
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = User::find(Auth::id());
        $user->setRememberToken($token = Str::random(60));
        $user->save();
        return $user;
    }
}
