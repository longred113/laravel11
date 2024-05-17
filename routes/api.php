<?php

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
        });
    });
