<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::view('login', 'auth.login')->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login.post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::redirect('/', '/login', 301);
