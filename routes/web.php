<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// mahasiswa
Route::controller(App\Http\Controllers\MahasiswaController::class)->group(function () {
    Route::get('/mahasiswa', 'index')->name('mahasiswa.index');
    Route::post('/mahasiswa', 'store')->name('mahasiswa.store');
});

// jadwal kuliah
Route::controller(App\Http\Controllers\JadwalKuliahController::class)->group(function () {
    Route::get('/jadwal-kuliah', 'index')->name('jadwal-kuliah.index');
    Route::post('/jadwal-kuliah', 'store')->name('jadwal-kuliah.store');
});
