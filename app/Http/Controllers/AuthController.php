<?php

namespace App\Http\Controllers;

use App\Http\Requests\{Auth\ForgotPasswordRequest, Auth\LoginRequest, Auth\RegisterRequest};
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'message' => trans('auth.failed')
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = User::find(Auth::user()->id);

        $token = $user->setRememberToken(Str::random(60));

        return response([
            'message' => 'You have logged in',
            'user' => $user
        ])->withCookie('token', $token);
    }


    public function logout()
    {
        Auth::logout();

        return response([
            'message' => trans('auth.logout')
        ]);
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);
        event(new Registered($user));
        // TODO --- Send letter to confirm email
        return response([
            'message' => trans('auth.registered'),
            'user' => $user
        ]);
    }


    public function forgotPassword(ForgotPasswordRequest $request) {

        $user = User::where('email', $request['email'])->first();

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
    }

    public function passwordReset(Request $request, $token) {



        return response([
            'message' => 'Password changed!'
        ]);
    }

}
