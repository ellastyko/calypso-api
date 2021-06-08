<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendMail;
// Models
use App\Models\User;


class AuthController extends Controller
{
    
    public function login(Request $request) {
        try {
            $fields = $request->validate([

                'login' => 'required|string',   
                'email' => 'required|string',        
                'password' => 'required|string'
            ]);

            $user = User::where('login', $fields['login'])->first();
            
            if ($user == null) {
                return response([
                    'message' => 'User isn`t exists'
                ]);
            }

            if ($user['email'] != $fields['email']) {
                return response([
                    'message' => 'E-mail isn`t correct'
                ]);
            }
            if (!Hash::check($fields['password'], $user['password'])) {
                return response([
                    'message' => 'Password isn`t correct'
                ]);
            }
            $token = $user->createToken('token')->plainTextToken;
            $user->update(['remember_token' => $token]);
            return response([
                'message' => 'You have logged in',
                'user' => $user,
                'token' => $token
                
            ]);

        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
        

    }

    public function logout() {


        $user = User::where('remember_token', explode('.', explode(' ', request()->header('Authorization'))[1]))->first();
        $user->update(['remember_token' => null]);
        return response([
            'message' => 'You have logged out'
        ]);
    }

    public function register(Request $request) {
        
        try {
            $fields = $request->validate([
                'login' => 'required|string|unique:users,login',
                'name' => 'string',                   
                'password' => 'required|string',
                'email' => 'required|string|unique:users,email',         
                'image' => 'string'
            ]);
            $user = User::create([
                'login' => $fields['login'],
                'name' => $fields['name'],
                'password' => Hash::make($fields['password']),           
                'email' => $fields['email'],
                'image' => $fields['image']
            ]);

        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 400);
        }
        
        return response([
            'message' => 'User have registered. Please log in',
            'user' => $user
        ]);
    }

    public function password_reset(Request $request) {

        $fields = $request->validate(['email' => 'required|string']);

        $user = User::where('email', $fields['email'])->first();

        if (!$user) {
            return [
                'message' => 'This email does not exist in database!'
            ];
        }
        $token = $user->createToken('mytoken')->plainTextToken;
        $user->update(['remember_token' => $token]);
        $details = [
            'title' => 'Link for reset password',
            'body' => URL::current().'/'.$token
        ];
        Mail::to($user)->send(new SendMail($details));
        return [
            'message' => 'Link was sent succeessfully!'
        ];


    }

    public function password_reset_confirm_token(Request $request, $token) {
        
        try {
            $fields = $request->validate(['password' => 'required|string']);
            $user = User::where(['remember_token' => $token])->first();
            if (!$user) {
                return [
                    'message' => 'Invalid link'
                ];
            }
            $user->update(['password' => Hash::make($fields['password'])]);
            $user->update(['remember_token' => null]);
        } catch (\Exception $e) {
            return [
                'message' => $e->getMessage()
            ];
        }
        
        return [
            'message' => 'Password successfully changed!'
        ];
    }
}
