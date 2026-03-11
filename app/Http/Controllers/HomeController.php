<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cidade;
use App\Models\Espaco;

class HomeController extends Controller
{
    public function index()
    {
        $usuarios = User::count();
        $cidades = Cidade::count();
        $espacos = Espaco::count();

        return view('home', compact(
            'usuarios',
            'cidades',
            'espacos'
        ));
    }
}
