<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    CategoryController,
    CommentController,
    PostController,
    ReactionController,
    UserController
};

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

Route::group([
    'prefix' => 'auth',
    'controller' => AuthController::class
], function () {

    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
    Route::post('/forgot-password', 'forgotPassword');
    Route::post('/password-reset', 'passwordReset');
});


Route::group([
    'prefix' => 'users',
    'controller' => UserController::class
], function () {

    Route::get('/', 'index');
    Route::get('/{user_id}', 'show');

    Route::middleware(['auth:sanctum', 'can:user'])->group(function () {

        Route::post('/', 'store');
        Route::patch('{user_id}', 'update');
        Route::delete('/{user_id}', 'destroy');
        Route::post('/avatar', 'avatar');

        Route::post('', 'status');
    });
});


Route::group([
    'prefix'     => 'categories',
    'controller' => CategoryController::class,
], function () {

    Route::get('/', 'index');
    Route::get('/{category_id}', 'show');

    Route::middleware(['auth:sanctum', 'can:admin'])->group(function () {

        Route::post('/', 'store');
        Route::patch('/{category_id}', 'update');
        Route::delete('/{category_id}', 'destroy');
    });
});


Route::group([
    'prefix'     => 'posts',
    'middleware' => 'auth:sanctum',
    'controller' => PostController::class,
], routes: function () {

    Route::get('/', 'index')->withoutMiddleware('auth:sanctum');

    Route::get('/my', 'myPosts');

    Route::post('/', 'store');

    Route::patch('/{post_id}/update', 'update')->can('update', \App\Models\Post::class);

    Route::patch('/{post_id}/ban', 'ban')->middleware('can:ban,post');

    Route::delete('/{post_id}', 'destroy')->middleware('can:delete,post');

    Route::get('/{post_id}', 'show')->withoutMiddleware('auth:sanctum');
});


Route::group([
    'prefix' => 'comments',
    'controller' => CommentController::class,
    'middleware' => 'auth:sanctum'
], function () {

    Route::get('/{comment_id}', 'show')
        ->withoutMiddleware('auth:sanctum');

    Route::patch('/{comment_id}', 'update');
    Route::delete('/{comment_id}', 'destroy');
});

Route::group([
    'prefix' => 'reactions',
    'controller' => ReactionController::class,
    'middleware' => 'auth:sanctum'
], function () {

    Route::get('/{id}', 'show')
        ->withoutMiddleware('auth:sanctum');

    Route::post('/{id}', 'store');
    Route::delete('/{id}', 'destroy');
});
