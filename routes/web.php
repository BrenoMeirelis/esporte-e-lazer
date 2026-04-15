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
| USUÁRIO LOGADO
|--------------------------------------------------------------------------
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
});

Route::middleware(['auth', 'admin'])->group(function () {

    // 🔥 CIDADES (SEM RESOURCE)
    Route::get('/cidades/create', [CidadeController::class, 'create'])->name('cidades.create');
    Route::post('/cidades', [CidadeController::class, 'store'])->name('cidades.store');
    Route::get('/cidades/{cidade}/edit', [CidadeController::class, 'edit'])->name('cidades.edit');
    Route::put('/cidades/{cidade}', [CidadeController::class, 'update'])->name('cidades.update');
    Route::delete('/cidades/{cidade}', [CidadeController::class, 'destroy'])->name('cidades.destroy');

    Route::middleware(['auth'])->group(function () {

        Route::resource('reservas', ReservaController::class);

    });

    Route::post('/cidades/{cidade}/adicionar-usuario', [CidadeController::class, 'adicionarUsuario'])
        ->name('cidades.adicionarUsuario');

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
});

Route::middleware(['auth'])->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // 🔥 SOMENTE VISUALIZAÇÃO
    Route::get('/cidades', [CidadeController::class, 'index'])->name('cidades.index');
    Route::get('/cidades/{cidade}', [CidadeController::class, 'show'])->name('cidades.show');

    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');

    Route::get('/cidades/{cidade}/espacos', [EspacoController::class, 'index'])
        ->name('espacos.index');

    Route::get('/calendario', [ReservaController::class, 'calendario'])->name('calendario');
    Route::get('/eventos', [ReservaController::class, 'eventos'])->name('eventos');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/


