<?php

use App\Http\Controllers\Auth\Social\Google;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\User\Index as UserIndex;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Welcome;

Route::get('/redirect', [Google::class,'redirect'])->name('google.redirect');
Route::get('/callback', [Google::class,'callback']);

Route::get('/',Welcome::class)->name('welcome');
/**
 * Authentication
 */
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::middleware(['auth:sanctum','verified','set-locale'])->group(function (){
    Route::get('/users', UserIndex::class)->name('dashboard');
    Route::get('/profile', Profile::class);

    Route::name('Users::')->group(function(){
        Route::get('/users', UserIndex::class)->name('index');
    });

});
