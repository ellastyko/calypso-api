<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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


Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'users'], function () {
    

    Route::get('', 'App\Http\Controllers\UserController@index');
    Route::get('/{id}', 'App\Http\Controllers\UserController@show');
    Route::post('', 'App\Http\Controllers\UserController@store');
    Route::patch('/avatar', 'App\Http\Controllers\UserController@avatar'); 
    Route::patch('{id}', 'App\Http\Controllers\UserController@update');
    Route::delete('/{id}', 'App\Http\Controllers\UserController@destroy');

});

// + GET - /api/posts- get all posts.This endpoint doesn't require any role, it ispublic. If there are too many posts, you must implement pagination. 
// + GET - /api/posts/<post_id>- get specified post data.Endpoint is public

// + GET - /api/posts/<post_id>/comments- get all comments for the specified post.Endpoint is public
// + POST - /api/posts/<post_id>/comments- create a new comment, required parameteris [content]
// + GET - /api/posts/<post_id>/categories- get all categories associated with thespecified post
// –GET - /api/posts/<post_id>/like- get all likes under the specified post
// + POST - /api/posts/- create a new post, required parameters are [title, content,categories]usof backend 



// –POST - /api/posts/<post_id>/like- create a new like under a post–
// + PATCH - /api/posts/<post_id>- update the specified post (its title, body orcategory). It's accessible only for the creator of the post–
// + DELETE - /api/posts/<post_id>- delete a post–
// DELETE - /api/posts/<post_id>/like- delete a like under a post

Route::prefix('posts')->group( function () {
    

    Route::get('', 'App\Http\Controllers\PostController@index');
    Route::middleware('auth:sanctum')->post('', 'App\Http\Controllers\PostController@store');   
    Route::get('/{post_id}', 'App\Http\Controllers\PostController@show');
    Route::middleware('auth:sanctum')->patch('/{post_id}', 'App\Http\Controllers\PostController@update'); 
    Route::middleware('auth:sanctum')->delete('/{post_id}', 'App\Http\Controllers\PostController@destroy'); 

    // Categories
    Route::get('/{post_id}/categories', 'App\Http\Controllers\PostController@show_categories'); 

    // Comments
    Route::get('/{post_id}/comments', 'App\Http\Controllers\PostController@show_comments'); 
    Route::middleware('auth:sanctum')->post('/{post_id}/comments', 'App\Http\Controllers\PostController@store_comment');


    // Likes
    Route::get('/{post_id}/like', 'App\Http\Controllers\PostController@show_likes');
    Route::middleware('auth:sanctum')->post('{post_id}/like', 'App\Http\Controllers\PostController@store_like');
    Route::middleware('auth:sanctum')->delete('{post_id}/like', 'App\Http\Controllers\PostController@destroy_like');
});




// GET - /api/categories- get all categories–
// GET - /api/categories/<category_id>- get specified category data–
// GET - /api/categories/<category_id>/posts- get all posts associated with thespecified category–
// POST - /api/categories- create a new category, required parameter is [title]–
// PATCH - /api/categories/<category_id>- update specified category data–
// DELETE - /api/categories/<category_id>- delete a category


Route::prefix('categories')->group( function () {
    

    Route::get('', 'App\Http\Controllers\CategoryController@index');
    Route::get('/{category_id}', 'App\Http\Controllers\CategoryController@show');

    Route::get('/{category_id}/posts', 'App\Http\Controllers\CategoryController@show_posts');

    Route::middleware('auth:sanctum')->post('', 'App\Http\Controllers\CategoryController@store'); 
    Route::middleware('auth:sanctum')->patch('{id}', 'App\Http\Controllers\CategoryController@update');

    Route::middleware('auth:sanctum')->delete('/{category_id}', 'App\Http\Controllers\CategoryController@destroy');

});




// GET - /api/comments/<comment_id>- get specified comment data–
// GET - /api/comments/<comment_id>/like- get all likes under the specifiedcomment–
// POST - /api/comments/<comment_id>/like- create a new like under a comment–
// PATCH - /api/comments/<comment_id>- update specified comment data–
// DELETE - /api/comments/<comment_id>- delete a comment–
// DELETE - /api/comments/<comment_id>/like- delete a like under a commen


Route::prefix('comments')->group( function () {
    

    Route::get('{comment_id}', 'App\Http\Controllers\CommentController@show');
    Route::middleware('auth:sanctum')->patch('{comment_id}', 'App\Http\Controllers\CommentController@update'); 
    Route::middleware('auth:sanctum')->delete('{comment_id}', 'App\Http\Controllers\CommentController@destroy'); 

    Route::get('{comment_id}/like', 'App\Http\Controllers\CommentController@show_likes'); 
    Route::middleware('auth:sanctum')->post('{comment_id}/like', 'App\Http\Controllers\CommentController@store_like');
    Route::middleware('auth:sanctum')->delete('{comment_id}/like', 'App\Http\Controllers\CommentController@destroy_like');

});



