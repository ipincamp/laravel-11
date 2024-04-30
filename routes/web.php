<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/mahasiswa', [App\Http\Controllers\MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::post('/mahasiswa', [App\Http\Controllers\MahasiswaController::class, 'store'])->name('mahasiswa.store');

Route::get('/jadwal-kuliah', [App\Http\Controllers\JadwalKuliahController::class, 'index'])->name('jadwal-kuliah.index');
Route::post('/jadwal-kuliah', [App\Http\Controllers\JadwalKuliahController::class, 'store'])->name('jadwal-kuliah.store');
