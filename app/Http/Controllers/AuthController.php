<?php

namespace App\Http\Controllers;


use App\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Auth\{ForgotPasswordRequest, LoginRequest, RegisterRequest};
use App\Models\User;
use Illuminate\Auth\Events\Registered;


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
        ])->withCookie('token', $token);
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
     * @return Response
     */
    public function register(RegisterRequest $request) : Response
    {
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
//            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        event(new PasswordReset($user));
//        event(new Registered($user));

        return response([
            'message' => trans('auth.registered'),
            'user' => $user
        ]);
    }


    public function forgotPassword(ForgotPasswordRequest $request) {


    }

    public function passwordReset(Request $request) {

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

        return response([
            'message' => 'Password changed!'
        ]);
    }

}
