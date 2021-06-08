<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// POST - /api/auth/register- registration of a new user, required parameters are[login, password, password confirmation, email]–
// POST - /api/auth/login- log in user, required parameters are [login, email,password]. Only users with a confirmed email can sign in–
// POST - /api/auth/logout- log out authorized user–
// POST - /api/auth/password-reset- send a reset link to user email, requiredparameter is [email]–POST - /api/auth/password-reset/<confirm_token>

Route::prefix('auth')->group( function() {

    Route::post('/register', 'App\Http\Controllers\AuthController@register');
    Route::post('/login', 'App\Http\Controllers\AuthController@login'); 
    Route::middleware('auth:sanctum')->post('/logout', 'App\Http\Controllers\AuthController@logout');

    Route::post('/password-reset', 'App\Http\Controllers\AuthController@password_reset');
    Route::post('/password-reset/{token}', 'App\Http\Controllers\AuthController@password_reset_confirm_token');
});

// GET - /api/users - get all users–
// GET - /api/users/<user_id>- get specified user data–
// POST - /api/users- create a new user, required parameters are [login, password,password confirmation, email, role]. This feature must be accessible only foradmins–
// PATCH - /api/users/avatar- upload user avatar–
// PATCH - /api/users/<user_id>- update user data–
// DELETE - /api/users/<user_id>- delete user

// Route(['middleware' => ['auth:sanctum']]::prefix('users')->group(  {
// ['middleware' => ['auth:sanctum'],

Route::middleware('auth:sanctum')->group( ['prefix' => 'users'], function () {
    
    Route::get('', 'App\Http\Controllers\UserController@index');
    Route::get('/{id}', 'App\Http\Controllers\UserController@show');
    Route::post('', 'App\Http\Controllers\UserController@store');
    Route::patch('/avatar', 'App\Http\Controllers\UserController@avatar');
    Route::patch('{id}', 'App\Http\Controllers\UserController@update');
    Route::delete('/{id}', 'App\Http\Controllers\UserController@destroy');

});