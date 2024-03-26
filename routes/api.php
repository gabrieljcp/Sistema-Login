<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserProfileController;

Route::post('/register', [LoginController::class, 'registerAPI']);

Route::post('/login', [LoginController::class, 'loginAPI']);

Route::post('/logout', [LoginController::class, 'logoutAPI']);

Route::post('/perfil', [UserProfileController::class, 'perfil']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/perfil', [UserProfileController::class, 'show']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
