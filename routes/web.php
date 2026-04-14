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
| ROTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

/* LOGIN */
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| BUSCAS (público)
|--------------------------------------------------------------------------
*/

Route::get('/buscar-espacos', [EspacoController::class, 'buscar'])->name('espacos.buscar');
Route::get('/buscar-cidades', [CidadeController::class, 'buscar'])->name('cidades.buscar');

/*
|--------------------------------------------------------------------------
| ROTAS PROTEGIDAS (USUÁRIO LOGADO)
|--------------------------------------------------------------------------
*/
Route::middleware(['guest'])->group(function () {
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

Route::middleware(['auth'])->group(function () {
    /* PERFIL */
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    /* VISUALIZAÇÃO */
    Route::resource('cidades', CidadeController::class)->only(['index', 'show']);
    Route::resource('categorias', CategoriaController::class)->only(['index', 'show']);

    Route::get('/cidades/{cidade_id}/espacos', [EspacoController::class, 'index'])
        ->name('espacos.index');

    /* RESERVAS */
    Route::get('/calendario', [ReservaController::class, 'calendario'])->name('calendario');
    Route::get('/eventos', [ReservaController::class, 'eventos'])->name('eventos');
});

/*
|--------------------------------------------------------------------------
| ROTAS ADMIN (SÓ ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {
    /* USERS (sem duplicar rotas!) */

    /* CIDADES */
    Route::get('/cidades/create', [CidadeController::class, 'create'])->name('cidades.create');
    Route::post('/cidades', [CidadeController::class, 'store'])->name('cidades.store');
    Route::get('/cidades/{cidade}/edit', [CidadeController::class, 'edit'])->name('cidades.edit');
    Route::put('/cidades/{cidade}', [CidadeController::class, 'update'])->name('cidades.update');
    Route::delete('/cidades/{cidade}', [CidadeController::class, 'destroy'])->name('cidades.destroy');

    Route::post('/cidades/{cidade}/adicionar-usuario', [CidadeController::class, 'adicionarUsuario'])
        ->name('cidades.adicionarUsuario');

    /* CATEGORIAS */
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

    /* ESPAÇOS */
    Route::get('/espacos/create/{cidade_id?}', [EspacoController::class, 'create'])
        ->name('espacos.create');

    Route::post('/espacos', [EspacoController::class, 'store'])
        ->name('espacos.store');

    Route::get('/espacos/{espaco}/edit', [EspacoController::class, 'edit'])
        ->name('espacos.edit');

    Route::put('/espacos/{espaco}', [EspacoController::class, 'update'])
        ->name('espacos.update');

    Route::delete('/espacos/{espaco}', [EspacoController::class, 'destroy'])
        ->name('espacos.destroy');
});
