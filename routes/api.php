<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/posts/{post}', [PostController::class, 'show']);
Route::get('/posts', [PostController::class, 'index']);

Route::group(['middleware' => ['auth:sanctum', 'userValid']], function () {
    Route::controller(PostController::class)->group(function () {
        Route::post('/posts', 'store');
        Route::put('/posts/{post}', 'update');
        Route::delete('/posts/{post}', 'destroy');
        Route::put('/posts/publish/{post}', 'publish');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/{user}', 'show');
        Route::put('/users/block/{user}', 'block');
    });
    Route::controller(CommentController::class)->group(function () {
        Route::get('/comments', 'index');
        Route::post('/posts/{post}/comments/{comment?}', 'store');
    });
});

Route::get('/sanctum/csrf-cookie', [LoginController::class, 'csrf']);

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'save']);

Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);
