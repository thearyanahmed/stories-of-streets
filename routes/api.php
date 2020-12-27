<?php

use App\Http\Controllers\Api\Auth\Login;
use App\Http\Controllers\Api\Auth\Logout;
use App\Http\Controllers\Api\Auth\Register;
use App\Http\Controllers\Api\Auth\User;
use App\Http\Controllers\Utils\SetLocale;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('Auth::')->group(function (){
    Route::post('/login',Login::class);
    Route::post('/register',Register::class);

    Route::middleware('auth:sanctum')->group(function() {
        Route::get('/user', User::class);
        Route::post('/logout',Logout::class);
    });
});

Route::middleware(['auth:sanctum','set-locale'])->group(function (){
    Route::post('locale/{locale}',SetLocale::class);
});

