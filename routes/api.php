<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    LikeController,
    UserController,
    PostController,
    CategoryController,
    CommentController
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

Route::prefix('auth')->group(function() {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/password-reset/{link}', [AuthController::class, 'passwordReset']);
});


Route::group([
    'middleware' => ['auth:sanctum', 'can:'],
    'prefix' => 'users'
], function () {

    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class,'show']);
    Route::post('', [UserController::class, 'store']);
    Route::patch('{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);

    Route::post('/avatar', [UserController::class, 'avatar']);
});


Route::prefix('categories')->group( function () {

    Route::get('', [CategoryController::class, 'index']);
    Route::get('/{category_id}', [CategoryController::class, 'show']);

    Route::middleware(['auth:sanctum', 'can:admin'])->group(function () {

        Route::post('', [CategoryController::class, 'store']);
        Route::patch('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });
});


Route::prefix('posts')->group(function () {

    Route::get('', [PostController::class, 'index']);
    Route::get('/{post_id}', [PostController::class, 'show']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::post('', [PostController::class, 'store']);

        Route::patch('/{post_id}', [PostController::class, 'update'])
                ->middleware('can:update,post');

        Route::delete('/{post_id}', [PostController::class, 'destroy'])
                ->middleware('can:delete,post');


        // Post Comments
        Route::post('/{post_id}/comments', [PostController::class, 'storeComment']);

        // Post Likes
        Route::post('{post_id}/like', [PostController::class, 'storeLike']);
        Route::delete('{post_id}/like', [PostController::class, 'destroyLike']);
    });
});


Route::group([
    'prefix' => 'comments',
    'middleware' => 'auth:sanctum'
], function () {

    Route::get('/{comment_id}', [CommentController::class, 'show'])->withoutMiddleware('auth:sanctum');
    Route::patch('/{comment_id}', [CommentController::class, 'update']);
    Route::delete('/{comment_id}', [CommentController::class, 'destroy']);
});

Route::group([
    'prefix' => 'likes',
    'middleware' => 'auth:sanctum'
], function () {

    Route::get('/{id}', [LikeController::class, 'show'])->withoutMiddleware('auth:sanctum');
    Route::post('/{id}', [LikeController::class, 'store']);
    Route::delete('/{id}', [LikeController::class, 'destroy']);
});
