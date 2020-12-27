<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Profile;

Route::view('/','welcome');
/**
 * Authentication
 */
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::middleware(['auth:sanctum','verified','set-locale'])->group(function (){
    Route::get('/users', Dashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class);

    Route::name('Users::')->group(function(){
        Route::get('/users', Dashboard::class)->name('index');
    });

});
