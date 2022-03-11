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

Route::prefix('auth')->group(function () {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/password-reset/{link}', [AuthController::class, 'passwordReset']);
});


Route::group([
    'prefix' => 'users',
], function () {

    Route::get('', [UserController::class, 'index']);
    Route::get('/{user_id}', [UserController::class, 'show']);

    Route::middleware(['auth:sanctum', 'can:user'])->group(function () {

        Route::post('', [UserController::class, 'store']);
        Route::patch('{user_id}', [UserController::class, 'update']);
        Route::delete('/{user_id}', [UserController::class, 'destroy']);
        Route::post('/avatar', [UserController::class, 'avatar']);
    });
});


Route::prefix('categories')->group(function () {

    Route::get('', [CategoryController::class, 'index']);
    Route::get('/{category_id}', [CategoryController::class, 'show']);

    Route::middleware(['auth:sanctum', 'can:admin'])->group(function () {

        Route::post('', [CategoryController::class, 'store']);
        Route::patch('/{category_id}', [CategoryController::class, 'update']);
        Route::delete('/{category_id}', [CategoryController::class, 'destroy']);
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
        Route::post('/{post_id}/like', [PostController::class, 'storeLike']);
        Route::delete('/{post_id}/like', [PostController::class, 'destroyLike']);
    });
});


Route::group([
    'prefix' => 'comments',
    'middleware' => 'auth:sanctum'
], function () {

    Route::get('/{comment_id}', [CommentController::class, 'show'])
        ->withoutMiddleware('auth:sanctum');

    Route::patch('/{comment_id}', [CommentController::class, 'update']);
    Route::delete('/{comment_id}', [CommentController::class, 'destroy']);
});

Route::group([
    'prefix' => 'reactions',
    'middleware' => 'auth:sanctum'
], function () {

    Route::get('/{id}', [ReactionController::class, 'show'])
        ->withoutMiddleware('auth:sanctum');

    Route::post('/{id}', [ReactionController::class, 'store']);
    Route::delete('/{id}', [ReactionController::class, 'destroy']);
});
