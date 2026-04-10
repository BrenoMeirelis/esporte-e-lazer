<?php

namespace App\Http\Controllers;

use App\Models\Espaco;
use App\Models\Cidade;
use App\Models\Categoria;
use Illuminate\Http\Request;

class EspacoController extends Controller
{
    public function index($cidade_id)
    {
        $cidade = Cidade::findOrFail($cidade_id);
        $espacos = Espaco::where('cidade_id', $cidade_id)->get();

        return view('espacos.index', compact('espacos', 'cidade'));
    }

    public function create($cidade_id = null)
    {
        if (!$cidade_id) {
            return redirect()->route('cidades.index')
                ->with('error', 'Selecione uma cidade primeiro');
        }

        $cidade = Cidade::findOrFail($cidade_id);
        $categorias = Categoria::where('cidade_id', $cidade_id)->get();

        return view('espacos.create', compact('cidade', 'categorias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'cidade_id' => 'required|exists:cidades,id',
            'categoria_id' => 'required|exists:categorias,id',
            'descricao' => 'nullable|string',
            'horario_abertura' => 'nullable|date_format:H:i',
            'horario_encerramento' => 'nullable|date_format:H:i',
            'periodo_max_reserva' => 'nullable|integer|min:0',
            'min_participantes' => 'nullable|integer|min:0',
            'max_participantes' => 'nullable|integer|min:0',
            'localizacao' => 'nullable|string|max:255',
            'regras' => 'nullable|string',
            'observacoes' => 'nullable|string',
            'materiais' => 'nullable|string',
            'responsavel' => 'nullable|string|max:255',
        ]);

        $validated['periodo_max_reserva'] = $validated['periodo_max_reserva'] ?? 0;
        $validated['min_participantes'] = $validated['min_participantes'] ?? 0;
        $validated['max_participantes'] = $validated['max_participantes'] ?? 0;

        Espaco::create($validated);

        return redirect()->route('cidades.show', $validated['cidade_id'])
            ->with('success', 'Espaço cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $espaco = Espaco::findOrFail($id);
        $categorias = Categoria::where('cidade_id', $espaco->cidade_id)->get();

        return view('espacos.edit', compact('espaco', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $espaco = Espaco::findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'cidade_id' => 'required|exists:cidades,id',
            'categoria_id' => 'required|exists:categorias,id',
            'descricao' => 'nullable|string',
            'horario_abertura' => 'nullable|date_format:H:i',
            'horario_encerramento' => 'nullable|date_format:H:i',
            'periodo_max_reserva' => 'nullable|integer|min:0',
            'localizacao' => 'nullable|string|max:255',
            'regras' => 'nullable|string',
            'observacoes' => 'nullable|string',
            'min_participantes' => 'nullable|integer|min:0',
            'max_participantes' => 'nullable|integer|min:0',
            'materiais' => 'nullable|string',
            'responsavel' => 'nullable|string|max:255',
        ]);

        $validated['periodo_max_reserva'] = $validated['periodo_max_reserva'] ?? 0;
        $validated['min_participantes'] = $validated['min_participantes'] ?? 0;
        $validated['max_participantes'] = $validated['max_participantes'] ?? 0;

        $espaco->update($validated);

        return redirect()->route('espacos.index', ['cidade_id' => $validated['cidade_id']])
            ->with('success', 'Espaço atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $espaco = Espaco::findOrFail($id);
        $cidade_id = $espaco->cidade_id;

        $espaco->delete();

        return redirect()->route('espacos.index', ['cidade_id' => $cidade_id])
            ->with('success', 'Espaço excluído com sucesso!');
    }

    public function buscar(Request $request)
    {
        $query = Espaco::query();

        if ($request->titulo) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        if ($request->categoria_id) {
            $query->where('categoria_id', $request->categoria_id);
        }

        $espacos = $query->get();
        $categorias = Categoria::all();

        return view('espacos.busca', compact('espacos', 'categorias'));
    }
}
