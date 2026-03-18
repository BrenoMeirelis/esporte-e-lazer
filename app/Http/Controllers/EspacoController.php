<?php

namespace App\Http\Controllers;

use App\Models\Espaco;
use App\Models\Cidade;
use Illuminate\Http\Request;

class EspacoController extends Controller
{
    // LISTAR ESPAÇOS POR CIDADE
    public function index($cidade_id)
    {
        $cidade = Cidade::findOrFail($cidade_id);
        $espacos = Espaco::where('cidade_id', $cidade_id)->get();

        return view('espacos.index', compact('espacos', 'cidade'));
    }

    // FORMULÁRIO DE CRIAÇÃO
    public function create(Request $request)
    {
        $cidade = Cidade::findOrFail($request->cidade_id);
        return view('espacos.create', compact('cidade'));
    }

    // SALVAR NOVO ESPAÇO
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

        // Valores padrão caso não sejam preenchidos
        $validated['periodo_max_reserva'] = $validated['periodo_max_reserva'] ?? 0;
        $validated['min_participantes'] = $validated['min_participantes'] ?? 0;
        $validated['max_participantes'] = $validated['max_participantes'] ?? 0;

        $espaco = Espaco::create($validated);

        return redirect()->route('espacos.index', ['cidade_id' => $request->cidade_id])
            ->with('success', 'Espaço criado com sucesso!');
    }

    // FORMULÁRIO DE EDIÇÃO
    public function edit(Espaco $espaco)
    {
        $cidades = Cidade::all();
        return view('espacos.edit', compact('espaco', 'cidades'));
    }

    // ATUALIZAR ESPAÇO
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

        return redirect()->route('espacos.index', ['cidade_id' => $request->cidade_id])
            ->with('success', 'Espaço atualizado com sucesso!');
    }

    // EXCLUIR ESPAÇO
    public function destroy(Espaco $espaco)
    {
        $cidade_id = $espaco->cidade_id;
        $espaco->delete();

        return redirect()->route('espacos.index', ['cidade_id' => $cidade_id])
            ->with('success', 'Espaço excluído com sucesso!');
    }

    // LISTAR ESPAÇOS POR ÁREA (opcional, se ainda usar)
    public function indexPorArea($area_id)
    {
        // Se não houver mais áreas, você pode remover este método
        // ou deixar caso queira filtrar por categoria futura
    }
}
