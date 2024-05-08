<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * Socialite routes
 */
Route::get('/auth/{provider}', [App\Http\Controllers\Auth\SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [App\Http\Controllers\Auth\SocialiteController::class, 'handleProviderCallback']);
