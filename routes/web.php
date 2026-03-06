<?php

use App\Http\Controllers\CidadeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::resource('users', UserController::class);

Route::resource('cidades', CidadeController::class);


