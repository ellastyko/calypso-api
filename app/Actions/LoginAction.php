<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class LoginAction
{

    /**
     * @param array $data
     * @return Response
     */
    public function handle(array $data): Response
    {
        if (!Auth::attempt($data)) {
            return response([
                'message' => trans('auth.failed')
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = User::find(Auth::id());

        $user->setRememberToken($token = Str::random(60));

        $user->save();

        return response([
            'message' => trans('auth.login'),
            'user' => $user
        ])->withCookie(['token' => $token]);
    }
}
