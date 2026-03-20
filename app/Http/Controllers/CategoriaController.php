<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Cidade;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index($cidade = null)
    {
        // Se vier cidade, filtra
        if ($cidade) {
            $categorias = Categoria::where('cidade_id', $cidade)->get();
        } else {
            $categorias = Categoria::all();
        }

        return view('categorias.index', compact('categorias', 'cidade'));
    }
    public function create()
    {
        $cidades = Cidade::all();
        return view('categorias.create', compact('cidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cidade_id' => 'required|exists:cidades,id'
        ]);

        Categoria::create($request->only(['nome', 'cidade_id']));

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria criada com sucesso!');
    }

    public function edit(Categoria $categoria)
    {
        $cidades = Cidade::all();
        return view('categorias.edit', compact('categoria', 'cidades'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cidade_id' => 'required|exists:cidades,id'
        ]);

        $categoria->update($request->only(['nome', 'cidade_id']));

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index')
            ->with('success', 'Categoria excluída com sucesso!');
    }

    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }
}
