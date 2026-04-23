<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\EspacoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\CategoriaController;

/*
|--------------------------------------------------------------------------
| PÚBLICO
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| BUSCAS
|--------------------------------------------------------------------------
*/

Route::get('/buscar-espacos', [EspacoController::class, 'buscar'])->name('espacos.buscar');
Route::get('/buscar-cidades', [CidadeController::class, 'buscar'])->name('cidades.buscar');

/*
|--------------------------------------------------------------------------
| CADASTRO DE USUÁRIO
|--------------------------------------------------------------------------
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    // CIDADES
    Route::get('/cidades/create', [CidadeController::class, 'create'])->name('cidades.create');
    Route::post('/cidades', [CidadeController::class, 'store'])->name('cidades.store');
    Route::get('/cidades/{cidade}/edit', [CidadeController::class, 'edit'])->name('cidades.edit');
    Route::put('/cidades/{cidade}', [CidadeController::class, 'update'])->name('cidades.update');
    Route::delete('/cidades/{cidade}', [CidadeController::class, 'destroy'])->name('cidades.destroy');

    // CATEGORIAS
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

    // ESPAÇOS
    Route::get('/espacos/create/{cidade_id?}', [EspacoController::class, 'create'])->name('espacos.create');
    Route::post('/espacos', [EspacoController::class, 'store'])->name('espacos.store');
    Route::get('/espacos/{espaco}/edit', [EspacoController::class, 'edit'])->name('espacos.edit');
    Route::put('/espacos/{espaco}', [EspacoController::class, 'update'])->name('espacos.update');
    Route::delete('/espacos/{espaco}', [EspacoController::class, 'destroy'])->name('espacos.destroy');

    // RESERVAS (ADMIN)
    Route::put('/reservas/{reserva}', [ReservaController::class, 'update'])->name('reservas.update');
    Route::delete('/reservas/{reserva}', [ReservaController::class, 'destroy'])->name('reservas.destroy');
});

/*
|--------------------------------------------------------------------------
| USUÁRIO AUTENTICADO
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // USERS
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // CIDADES
    Route::get('/cidades', [CidadeController::class, 'index'])->name('cidades.index');
    Route::get('/cidades/{cidade}', [CidadeController::class, 'show'])->name('cidades.show');

    Route::post('/cidades/{cidade}/adicionar-usuario', [CidadeController::class, 'adicionarUsuario'])
        ->name('cidades.adicionarUsuario');

    // CATEGORIAS
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');

    // ESPAÇOS
    Route::get('/cidades/{cidade}/espacos', [EspacoController::class, 'index'])->name('espacos.index');

    /*
    |--------------------------------------------------------------------------
    | RESERVAS (LIMPO E CORRETO)
    |--------------------------------------------------------------------------
    */

    Route::middleware(['auth'])->group(function () {

        Route::get('/reservas', [ReservaController::class, 'index'])
            ->name('reservas.index');

        Route::get('/reservas/create/{espaco_id}', [ReservaController::class, 'create'])
            ->name('reservas.create');

        Route::post('/reservas', [ReservaController::class, 'store'])
            ->name('reservas.store');

        Route::get('/reservas/{reserva}', [ReservaController::class, 'show'])
            ->name('reservas.show');

        Route::get('/reservas/{reserva}/edit', [ReservaController::class, 'edit'])
            ->name('reservas.edit');

        Route::put('/reservas/{reserva}', [ReservaController::class, 'update'])
            ->name('reservas.update');

        Route::delete('/reservas/{reserva}', [ReservaController::class, 'destroy'])
            ->name('reservas.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | CALENDÁRIO
    |--------------------------------------------------------------------------
    */

    Route::get('/calendario', [ReservaController::class, 'calendario'])->name('calendario');
    Route::get('/eventos', [ReservaController::class, 'eventos'])->name('eventos');

    Route::get('/reservas/calendario', [ReservaController::class, 'calendario'])
        ->name('reservas.calendario');

    Route::get('/reservas/eventos', [ReservaController::class, 'eventos'])
        ->name('reservas.eventos');
});
