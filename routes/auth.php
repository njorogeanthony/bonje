<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::view('login', 'auth.login')->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login.post');
