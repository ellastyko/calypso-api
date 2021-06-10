<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function isAdmin() {

        $user = $this->user();
        if (!$user) 
            return false;
        return ($user->role == 'admin') ?  true : false;
    }

    public function user() {
        $token = explode(' ', request()->header('Authorization'))[1];
        return User::where(['remember_token' => $token])->first();
    }
}
