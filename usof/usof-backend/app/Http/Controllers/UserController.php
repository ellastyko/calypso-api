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
            ], 400);
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

        $u = User::where(['id' => $id])->first();
        if (!$u) {
            return response([
                'message' => 'There is no such user'
            ], 400);
        }

        if ($this->isAdmin() == true) {
            foreach ($fields as $key => $value) 
                $u->update([$key => $value]);         
        }
        else {

            $user = $this->user();
            if ($user->id != $id) {
                return response([
                    'message' => 'You have no rights to edit this account'
                ], 400);
            }
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
        try {
            
            if ($this->isAdmin() != true) {

                $user = $this->user();
    
                if (!$user) {
                    return response([
                        'message' => 'Something wrong'
                    ], 400);
                }
                if ($id != $user->id) {
                    return response([
                        'message' => "You can`t delete someone else's account"
                    ], 400);
                }
                
            } 
            
    
            if (!User::find($id)) {
                return response([
                    'message' => 'User isn`t exists'
                ], 400);
            }
            User::destroy($id);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 400);
        }
        
        return response([
            'message' => 'User deleted successfully'
        ]);
    }
}
