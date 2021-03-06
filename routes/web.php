<?php

use App\Http\Controllers\Auth\Social\Google;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\User\Index as UserIndex;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Welcome;
use Spatie\ResponseCache\Facades\ResponseCache;
use App\Http\Livewire\Story\Read;

Route::get('/redirect', [Google::class,'redirect'])->name('google.redirect');
Route::get('/callback', [Google::class,'callback']);

/**
 * Authentication
 */
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
     Route::get('/register', Register::class)->name('register');
});

Route::middleware(['auth:sanctum','verified'])->group(function (){
    Route::get('/clear-response',function() {
        ResponseCache::clear();

        return 'Response cache cleared.';
    });

    Route::get('/users', UserIndex::class)->name('dashboard');
    Route::get('/profile', Profile::class);

    Route::name('Users::')->group(function(){
        Route::get('/users', UserIndex::class)->name('index');
    });
});



// Route::middleware('cache')->group(function(){
    Route::get('/',Welcome::class)->name('welcome');
    Route::get('/users/{id}',\App\Http\Livewire\User\View::class)->name('users.read');
    Route::get('/{slug}',Read::class)->name('story.read');

// });
