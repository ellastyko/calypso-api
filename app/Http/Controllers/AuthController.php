<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Http\Requests\{
    LoginRequest,
    RegisterRequest,
    ForgotRequest
};

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        // TODO --- Send letter to confirm password
        return response([
            'message' => trans('auth.registered'),
            'user' => $user
        ]);
    }


    public function forgotPassword(ForgotRequest $request) {

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


            $fields = $request->validate(['password' => 'required|string']);
            $user = User::where(['remember_token' => $token])->first();

            $user->update(['password' => Hash::make($fields['password'])]);
            $user->update(['remember_token' => null]);

        return response([
            'message' => 'Password changed!'
        ]);
    }

}
