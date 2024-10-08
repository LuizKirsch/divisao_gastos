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

//rota de usuários
Route::middleware('auth')->group(function () {
    Route::prefix('')->name('user.')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::resource('/event', EventController::class);
    });
});
