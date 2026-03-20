<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\EspacoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\CategoriaController;




Route::get('/buscar-espacos', [EspacoController::class, 'buscar'])->name('espacos.buscar');
Route::get('/buscar-cidades', [CidadeController::class, 'buscar'])->name('cidades.buscar');

Route::get('categorias-cidade/{cidade?}', [CategoriaController::class, 'index'])->name('categorias.index');
Route::resource('categorias', CategoriaController::class)->except(['index']);
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

/* CADASTRO DE USUÁRIO */
Route::resource('users', UserController::class)->only(['create', 'store']);

/*
|--------------------------------------------------------------------------
| ROTAS PROTEGIDAS (AUTH)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /* USUÁRIOS */
    Route::resource('users', UserController::class)
        ->only(['index', 'edit', 'update', 'show', 'destroy']);

    /* CIDADES */
    Route::resource('cidades', CidadeController::class);
    Route::post('/cidades/{cidade}/adicionar-usuario', [CidadeController::class, 'adicionarUsuario'])
        ->name('cidades.adicionarUsuario');

    // ESPAÇOS

    // LISTAR ESPAÇOS POR CIDADE
    Route::get('/cidades/{cidade_id}/espacos', [EspacoController::class, 'index'])
    ->name('espacos.index');

    // CREATE (AGORA FUNCIONA COM OU SEM PARÂMETRO)
    Route::get('/espacos/create/{cidade_id?}', [EspacoController::class, 'create'])
    ->name('espacos.create');

    // STORE
    Route::post('/espacos', [EspacoController::class, 'store'])
    ->name('espacos.store');

    // EDIT
    Route::get('/espacos/{espaco}/edit', [EspacoController::class, 'edit'])
    ->name('espacos.edit');

    // UPDATE
    Route::put('/espacos/{espaco}', [EspacoController::class, 'update'])
    ->name('espacos.update');

    // DELETE
    Route::delete('/espacos/{espaco}', [EspacoController::class, 'destroy'])
    ->name('espacos.destroy');


    Route::get('/calendario', [ReservaController::class, 'calendario'])
        ->name('reservas.calendario');

    Route::get('/eventos', [ReservaController::class, 'eventos'])
        ->name('reservas.eventos');
});
