<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Cidade; // ✅ CORRIGIDO
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
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

        Categoria::create($request->all());

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria criada com sucesso!');
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        $cidades = Cidade::all();

        return view('categorias.edit', compact('categoria', 'cidades'));
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255',
            'cidade_id' => 'required|exists:cidades,id'
        ]);

        $categoria->update($request->all());

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy($id)
    {
        Categoria::destroy($id);

        return back()->with('success', 'Categoria excluída com sucesso!');
    }
}
