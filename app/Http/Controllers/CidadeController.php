<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function index()
    {
        $cidades = Cidade::all();
        return view('cidades.index', compact('cidades'));
    }

    public function create()
    {
        return view('cidades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cep' => 'required',
            'uf' => 'required|max:2',
            'email' => 'nullable|email'
        ]);

        Cidade::create($request->all());

        return redirect()->route('cidades.index')
            ->with('success', 'Cidade cadastrada com sucesso!');
    }

    public function show(Cidade $cidade)
    {
        return view('cidades.show', compact('cidade'));
    }

    public function edit(Cidade $cidade)
    {
        return view('cidades.edit', compact('cidade'));
    }

    public function update(Request $request, Cidade $cidade)
    {
        $request->validate([
            'nome' => 'required',
            'cep' => 'required',
            'uf' => 'required|max:2',
            'email' => 'nullable|email'
        ]);

        $cidade->update($request->all());

        return redirect()->route('cidades.index')
            ->with('success', 'Cidade atualizada com sucesso!');
    }

    public function destroy(Cidade $cidade)
    {
        $cidade->delete();

        return redirect()->route('cidades.index')
            ->with('success', 'Cidade excluída com sucesso!');
    }
}
