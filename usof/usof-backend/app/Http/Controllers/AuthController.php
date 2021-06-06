<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Mail\Email;
// Models
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        // auth()->user()->tokens()->delete();

        // Auth::user()->tokens->each(function($token, $key) {
        //     $token->delete();
        // });
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
            'message' => 'User registered. Please log in',
            'user' => $user
        ]);
    }

    public function password_reset(Request $request) {
        
    }

    public function password_reset_confirm_token(Request $request) {
        
    }
}
