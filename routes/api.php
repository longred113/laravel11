<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::prefix('user')
    ->name('user.')
    ->group(function () {
        Route::post('register', [UserController::class, "register"]);
        Route::post('login', [UserController::class, "login"]);
        Route::group(["middleware" => "auth:api"], function () {
            Route::get('/profile', [UserController::class, "profile"]);
            Route::get('/logout', [UserController::class, "logout"]);
        });
    });
Route::prefix('category')
    ->name('category.')
    ->group(function () {
        Route::group(["middleware" => "auth:api"], function () {
            Route::get('/', [CategoryController::class, "index"]);
            Route::post('/create', [CategoryController::class, "store"]);
            Route::post('/find', [CategoryController::class, "show"]);
        });
    });
