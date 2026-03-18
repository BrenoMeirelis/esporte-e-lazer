<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\EspacoController;
use App\Http\Controllers\ReservaController;

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

    /*
    |--------------------------------------------------------------------------
    | ESPAÇOS
    |--------------------------------------------------------------------------
    */

    // LISTAR ESPAÇOS POR CIDADE
    Route::get('/cidades/{cidade_id}/espacos', [EspacoController::class, 'index'])
        ->name('espacos.index');

    // FORMULÁRIO DE CRIAÇÃO DE ESPAÇO (precisa de cidade_id)
    Route::get('/espacos/create', [EspacoController::class, 'create'])
        ->name('espacos.create');

    // SALVAR NOVO ESPAÇO
    Route::post('/espacos', [EspacoController::class, 'store'])
        ->name('espacos.store');

    // EDITAR ESPAÇO
    Route::get('/espacos/{espaco}/edit', [EspacoController::class, 'edit'])
        ->name('espacos.edit');

    // ATUALIZAR ESPAÇO
    Route::put('/espacos/{espaco}', [EspacoController::class, 'update'])
        ->name('espacos.update');

    // EXCLUIR ESPAÇO
    Route::delete('/espacos/{espaco}', [EspacoController::class, 'destroy'])
        ->name('espacos.destroy');

    /*
    |--------------------------------------------------------------------------
    | RESERVAS
    |--------------------------------------------------------------------------
    */
    Route::resource('reservas', ReservaController::class);

    Route::get('/calendario', [ReservaController::class, 'calendario'])
        ->name('reservas.calendario');

    Route::get('/eventos', [ReservaController::class, 'eventos'])
        ->name('reservas.eventos');

});
