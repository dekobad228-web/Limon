<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{LoginController, LogoutController, RegisterController};

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
