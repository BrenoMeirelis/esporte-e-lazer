<?php

use App\Http\Controllers\CidadeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EspacoController;
use App\Http\Controllers\ReservaController;


Route::resource('reservas', ReservaController::class);
Route::get('/calendario', [ReservaController::class,'calendario']);
Route::get('/eventos', [ReservaController::class,'eventos']);

Route::resource('espacos', EspacoController::class);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('users', UserController::class)->only(['create', 'store']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::resource('users', UserController::class)->only(['index','edit','update','show','destroy']);

    Route::resource('cidades', CidadeController::class);

});
