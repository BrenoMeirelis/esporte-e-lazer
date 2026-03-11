<?php

namespace App\Http\Controllers;

use App\Models\Espaco;
use App\Models\Cidade;
use Illuminate\Http\Request;

class EspacoController extends Controller
{
    public function index()
    {
        $espacos = Espaco::with('cidade')->get();
        return view('espacos.index', compact('espacos'));
    }

    public function create()
    {
        $cidades = Cidade::all();
        return view('espacos.create', compact('cidades'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'cidade_id' => 'required|exists:cidades,id',
            'descricao' => 'nullable|string',
            'horario_abertura' => 'nullable',
            'horario_encerramento' => 'nullable',
            'periodo_max_reserva' => 'nullable|integer',
            'localizacao' => 'nullable|string|max:255',
            'regras' => 'nullable|string',
            'observacoes' => 'nullable|string',
            'min_participantes' => 'nullable|integer',
            'max_participantes' => 'nullable|integer',
            'materiais' => 'nullable|string',
            'responsavel' => 'nullable|string|max:255',
        ]);

        // Garantir valores padrão se algum campo numérico estiver vazio
        $validated['periodo_max_reserva'] = $validated['periodo_max_reserva'] ?? 0;
        $validated['min_participantes'] = $validated['min_participantes'] ?? 0;
        $validated['max_participantes'] = $validated['max_participantes'] ?? 0;

        Espaco::create($validated);

        return redirect()->route('espacos.index')
            ->with('success', 'Espaço criado com sucesso!');
    }

    public function edit(Espaco $espaco)
    {
        $cidades = Cidade::all();
        return view('espacos.edit', compact('espaco', 'cidades'));
    }

    public function update(Request $request, Espaco $espaco)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'cidade_id' => 'required|exists:cidades,id',
            'descricao' => 'nullable|string',
            'horario_abertura' => 'nullable',
            'horario_encerramento' => 'nullable',
            'periodo_max_reserva' => 'nullable|integer',
            'localizacao' => 'nullable|string|max:255',
            'regras' => 'nullable|string',
            'observacoes' => 'nullable|string',
            'min_participantes' => 'nullable|integer',
            'max_participantes' => 'nullable|integer',
            'materiais' => 'nullable|string',
            'responsavel' => 'nullable|string|max:255',
        ]);

        $validated['periodo_max_reserva'] = $validated['periodo_max_reserva'] ?? 0;
        $validated['min_participantes'] = $validated['min_participantes'] ?? 0;
        $validated['max_participantes'] = $validated['max_participantes'] ?? 0;

        $espaco->update($validated);

        return redirect()->route('espacos.index')
            ->with('success', 'Espaço atualizado com sucesso!');
    }

    public function destroy(Espaco $espaco)
    {
        $espaco->delete();

        return redirect()->route('espacos.index')
            ->with('success', 'Espaço excluído com sucesso!');
    }
}
