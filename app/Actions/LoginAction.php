<?php

namespace App\Actions;

use App\Models\User;
use HttpException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginAction
 */
class LoginAction
{

    /**
     * @param array $credentials
     * @return Response
     * @throws HttpException
     */
    public function handle(array $credentials): Response
    {
        if (!Auth::attempt($credentials))
            throw new HttpException(401, trans('auth.failed'));

        $user = User::find(Auth::id());

        $token = $user->createToken('token')->plainTextToken;

        return response([
            'message' => trans('auth.login'),
            'user' => $user,
            'token' => $token
        ]);
    }
}
