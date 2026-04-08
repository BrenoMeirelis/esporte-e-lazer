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
| BUSCAS
|--------------------------------------------------------------------------
*/

Route::get('/buscar-espacos', [EspacoController::class, 'buscar'])->name('espacos.buscar');
Route::get('/buscar-cidades', [CidadeController::class, 'buscar'])->name('cidades.buscar');

/*
|--------------------------------------------------------------------------
| CATEGORIAS
|--------------------------------------------------------------------------
*/

Route::get('categorias-cidade/{cidade?}', [CategoriaController::class, 'index'])->name('categorias.index');
Route::resource('categorias', CategoriaController::class)->except(['index']);

/*
|--------------------------------------------------------------------------
| USERS
|--------------------------------------------------------------------------
*/

/* Criar usuário → só admin */
Route::resource('users', UserController::class)
    ->only(['create', 'store']);


/* Listar usuários → só admin */
Route::get('/users', [UserController::class, 'index'])
    ->middleware(['auth', 'isSuperAdmin'])
    ->name('users.index');

/* Restante → usuário logado */
Route::middleware(['auth'])->group(function () {

    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

});

/*
|--------------------------------------------------------------------------
| ROTAS PROTEGIDAS (ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'isSuperAdmin'])->group(function () {

    /* CIDADES */
    Route::resource('cidades', CidadeController::class);

    Route::post('/cidades/{cidade}/adicionar-usuario', [CidadeController::class, 'adicionarUsuario'])
        ->name('cidades.adicionarUsuario');

    /* ESPAÇOS */
    Route::get('/cidades/{cidade_id}/espacos', [EspacoController::class, 'index'])
        ->name('espacos.index');

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

    /* RESERVAS */
    Route::get('/calendario', [ReservaController::class, 'calendario'])
        ->name('reservas.calendario');

    Route::get('/eventos', [ReservaController::class, 'eventos'])
        ->name('reservas.eventos');
});
