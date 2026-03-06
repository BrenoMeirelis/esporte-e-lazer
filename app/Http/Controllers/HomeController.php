<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cidade;
use App\Models\Categoria;

class HomeController extends Controller
{
    public function index()
    {
        $usuarios = User::count();
        $cidades = Cidade::count();
        $categorias = Categoria::count();

        return view('home', compact(
            'usuarios',
            'cidades',
            'categorias'
        ));
    }
}
