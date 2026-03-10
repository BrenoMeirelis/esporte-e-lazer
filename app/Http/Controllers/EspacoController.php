<?php

namespace App\Http\Controllers;

use App\Models\Espaco;
use Illuminate\Http\Request;

class EspacoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $espacos = Espaco::with('cidade')->get();
    return view('espacos.index', compact('espacos'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $cidades = Cidade::all();
    return view('espacos.create', compact('cidades'));
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    Espaco::create($request->all());

    return redirect()->route('espacos.index')
        ->with('success', 'Espaço criado com sucesso');
}

    /**
     * Display the specified resource.
     */
    public function show(Espaco $espaco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Espaco $espaco)
{
    $cidades = Cidade::all();
    return view('espacos.edit', compact('espaco','cidades'));
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Espaco $espaco)
    {
        $espaco->update($request->all());

        return redirect()->route('espacos.index')
            ->with('success', 'Espaço atualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Espaco $espaco)
{
    $espaco->delete();

    return redirect()->route('espacos.index');
}
}
