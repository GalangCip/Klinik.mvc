<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasienController;

Route::get('/',          [AuthController::class,  'showLogin'])->name('login');
Route::get('/login',     [AuthController::class,  'showLogin'])->name('login');
Route::post('/login',    [AuthController::class,  'login'])->name('login.post');
Route::get('/logout',    [AuthController::class,  'logout'])->name('logout');
Route::get('/dashboard', [PasienController::class,'dashboard'])->name('dashboard');