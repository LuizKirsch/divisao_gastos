<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;

Route::get('/welcome', function () {
    return view('welcome');
});

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login_action'])->name('user.login_action');

// Rotas de resete de senha
Route::get('/forgot-password', [AuthController::class, 'forgot_pass'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'send_reset_link'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'show_reset_form'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'reset_password'])->middleware('guest')->name('password.update');

//rota de usuários
Route::middleware('auth')->group(function () {
    Route::prefix('')->name('user.')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::resource('/event', EventController::class);
    });
});

