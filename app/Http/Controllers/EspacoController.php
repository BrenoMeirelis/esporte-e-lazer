<?php

namespace App\Http\Controllers;

use App\Models\Espaco;
use App\Models\Cidade;
use App\Models\Categoria; // ✅ CORRIGIDO
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
        $categorias = Categoria::all();
        $cidade = Cidade::findOrFail($request->cidade_id); // ✅ AQUI

        return view('espacos.create', compact('categorias', 'cidade'));
    }

    // SALVAR NOVO ESPAÇO
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255', // ✅ PADRONIZADO
            'cidade_id' => 'required|exists:cidades,id',
            'categoria_id' => 'nullable|exists:categorias,id',
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

        // valores padrão
        $validated['periodo_max_reserva'] = $validated['periodo_max_reserva'] ?? 0;
        $validated['min_participantes'] = $validated['min_participantes'] ?? 0;
        $validated['max_participantes'] = $validated['max_participantes'] ?? 0;

        Espaco::create($validated);

        return redirect()->route('espacos.index', ['cidade_id' => $request->cidade_id])
            ->with('success', 'Espaço criado com sucesso!');
    }

    // FORMULÁRIO DE EDIÇÃO
    public function edit($id)
    {
        $espaco = Espaco::findOrFail($id);
        $categorias = Categoria::all();

        return view('espacos.edit', compact('espaco', 'categorias'));
    }

    // ATUALIZAR ESPAÇO
    public function update(Request $request, $id)
    {
        $espaco = Espaco::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cidade_id' => 'required|exists:cidades,id',
            'categoria_id' => 'nullable|exists:categorias,id',
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

    // EXCLUIR
    public function destroy($id)
    {
        $espaco = Espaco::findOrFail($id);
        $cidade_id = $espaco->cidade_id;

        $espaco->delete();

        return redirect()->route('espacos.index', ['cidade_id' => $cidade_id])
            ->with('success', 'Espaço excluído com sucesso!');
    }

    // BUSCA DE ESPAÇOS
    public function buscar(Request $request)
    {
        $query = Espaco::query();

        if ($request->nome) {
            $query->where('nome', 'like', '%' . $request->nome . '%');
        }

        if ($request->categoria_id) {
            $query->where('categoria_id', $request->categoria_id);
        }

        $espacos = $query->get();
        $categorias = Categoria::all();

        return view('espacos.busca', compact('espacos', 'categorias'));
    }
}
