<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginAction
{

    /**
     * @param array $credentials
     * @return Response
     */
    public function handle(array $credentials): Response
    {
        if (!Auth::attempt($credentials)) {
            return response([
                'message' => trans('auth.failed')
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = User::find(Auth::id());

        $token = $user->createToken('token')->plainTextToken;

        return response([
            'message' => trans('auth.login'),
            'user' => $user,
            'token' => $token
        ])->withCookie('token', $token);
    }
}
