<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ?
        if ($this->isAdmin() == false) {
            return response([
                'message' => 'You are not admin'
            ]);
        }

        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        try {
                 
            if ($this->isAdmin() == false) {
                return response([
                    'message' => 'You are not admin'
                ]);
            }

            $fields = $request->validate([
                'login' => 'required|string|unique:users,login',
                'name' => 'string',                   
                'password' => 'required|string',
                'repeat_password' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'role' => 'string'
            ]);
            if ($fields['password'] != $fields['repeat_password']) {
                return response([
                    'message' => 'Passwords are different'
                ]);
            }
            $user = User::create([
                'login' => $fields['login'],
                'name' => $fields['name'],
                'password' => Hash::make($fields['password']),           
                'email' => $fields['email'],
                'role' => $fields['role']
            ]);

        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 400);
        }    

        
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // ?
        if ($this->isAdmin() == false) {
            return response([
                'message' => 'You are not admin'
            ]);
        }
        return User::where(['id' => $id])->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'login' => 'string',
            'name' => 'string',                   
            'password' => 'string',
            'image' => 'string',
            'rating' => 'string',
            'email' => 'string',
            'role' => 'string'
        ]);
        
        if ($this->isAdmin() == true) {

            $user = User::where(['id' => $id])->first();
            if (!$user) {
                return response([
                    'message' => 'There is no such user'
                ], 400);
            }
  
            foreach ($fields as $key => $value) 
                $user->update([$key => $value]);         
        }
        else {

            $token = explode(' ', request()->header('Authorization'))[1];      
            $user = User::where(['remember_token' => $token, 'id' => $id])->first();
            if (!$user) {
                return response([
                    'message' => 'Something wrong'
                ], 400);
            }
            foreach ($fields as $key => $value) {
                if ($key == 'password' || $key == 'name')
                    $user->update([$key => $value]);
            }               
        }

        
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if ($this->isAdmin() != true) {
            $token = explode(' ', request()->header('Authorization'))[1];      
            $user = User::where(['remember_token' => $token, 'id' => $id])->first();
            if (!$user) {
                return response([
                    'message' => 'Something wrong'
                ], 400);
            }
        } 
        

        if (!User::find($id)) {
            return response([
                'message' => 'User isn`t exists'
            ], 400);
        }
        User::destroy($id);
    }
}
