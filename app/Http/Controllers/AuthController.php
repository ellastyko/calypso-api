<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Auth\{ForgotPasswordRequest, LoginRequest, PasswordResetRequest, RegisterRequest};
use App\Actions\{ForgotPasswordAction, LoginAction, PasswordResetAction, UserRegisterAction};

/**
 * Class Description
 */
class AuthController extends Controller
{
    /**
     * use SomeTrait;
     *
     * public const $temp = [];
     */
    /**
     * @param LoginRequest $request
     * @param LoginAction $action
     * @return Response
     */
    public function login(LoginRequest $request, LoginAction $action): Response
    {
        return response([
            'message' => trans('auth.login'),
            'user' => $action->handle($request)
        ]);
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
        return response([
            'message' => trans('auth.registered'),
            'user' => $action->handle($request->validated())
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
    public function passwordReset(PasswordResetRequest $request, PasswordResetAction $action): Response
    {
        $action->handle($request->validated());

        return response([
            'message' => trans('passwords.reset')
        ]);
    }
}
