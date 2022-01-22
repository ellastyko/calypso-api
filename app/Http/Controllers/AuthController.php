<?php

namespace App\Http\Controllers;


use App\Actions\ForgotPasswordAction;
use App\Actions\PasswordResetAction;
use App\Actions\UserRegisterAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Auth\{ForgotPasswordRequest, LoginRequest, PasswordResetRequest, RegisterRequest};
use App\Models\User;


class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return Response
     */
    public function login(LoginRequest $request) : Response
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
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
        ])->withCookie('link', $token);
    }

    /**
     * @return Response
     */
    public function logout() : Response
    {
        Auth::logout();
        return response([
            'message' => trans('auth.logout')
        ]);
    }

    /**
     * @param RegisterRequest $request
     * @param UserRegisterAction $action
     * @return Response
     */
    public function register(RegisterRequest $request, UserRegisterAction $action) : Response
    {
        $user = $action->handle($request->validated());

        return response([
            'message' => trans('auth.registered'),
            'user' => $user
        ]);
    }

    /**
     * @param ForgotPasswordRequest $request
     * @param ForgotPasswordAction $action
     * @return Response
     */
    public function forgotPassword(ForgotPasswordRequest $request, ForgotPasswordAction $action): Response
    {
        $action->handle($request->only('email'));

        return response([
            'message' => trans('passwords.sent')
        ]);
    }


    /**
     * @param PasswordResetRequest $request
     * @param PasswordResetAction $action
     * @return Response
     */
    public function passwordReset(PasswordResetRequest $request, PasswordResetAction $action) {

        $action->handle($request->validated());

        return response([
            'message' => trans('passwords.reset')
        ]);
    }

}
