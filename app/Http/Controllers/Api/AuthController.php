<?php

namespace App\Http\Controllers\Api;

use App\Actions\{ForgotPasswordAction, LoginAction, PasswordResetAction, RegisterAction};
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\{ForgotPasswordRequest, LoginRequest, PasswordResetRequest, RegisterRequest};
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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
    public function logout(): Response
    {
        Auth::logout();

        return response()->json([
            'message' => trans('auth.logout')
        ], Response::HTTP_NO_CONTENT);
    }

    /**
     * @param RegisterRequest $request
     * @param RegisterAction $action
     * @return JsonResponse
     */
    public function register(RegisterRequest $request, RegisterAction $action): JsonResponse
    {
        return response()->json([
            'message' => trans('auth.registered'),
            'user'    => $action->handle($request->validated())
        ]);
    }

    /**
     * @param ForgotPasswordRequest $request
     * @param ForgotPasswordAction $action
     * @return JsonResponse
     */
    public function forgotPassword(ForgotPasswordRequest $request, ForgotPasswordAction $action): JsonResponse
    {
        $status = $action->handle($request->only('email'));

        return response()->json([
            'message' => trans($status)
        ]);
    }


    /**
     * @param PasswordResetRequest $request
     * @param PasswordResetAction $action
     * @return Response
     */
    public function passwordReset(PasswordResetRequest $request, PasswordResetAction $action): Response
    {
        $status = $action->handle($request->validated());

        return response()->json([
            'message' => trans($status)
        ]);
    }
}
