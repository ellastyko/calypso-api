<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Auth\{ForgotPasswordRequest, LoginRequest, PasswordResetRequest, RegisterRequest};
use App\Actions\{ForgotPasswordAction, LoginAction, PasswordResetAction, RegisterAction};

/**
 * Authentication controller
 */
class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @param LoginAction $action
     * @return Response
     */
    public function login(LoginRequest $request, LoginAction $action): Response
    {
        return $action->handle($request->only('email', 'password'));
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
     * @param RegisterAction $action
     * @return Response
     */
    public function register(RegisterRequest $request, RegisterAction $action) : Response
    {
        return  $action->handle($request->validated());
    }

    /**
     * @param ForgotPasswordRequest $request
     * @param ForgotPasswordAction $action
     * @return Response
     */
    public function forgotPassword(ForgotPasswordRequest $request, ForgotPasswordAction $action): Response
    {
        return $action->handle($request->only('email'));
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
