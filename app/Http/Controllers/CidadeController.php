<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\User;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    // LISTAR CIDADES
    public function index()
    {
        $cidades = Cidade::all();
        return view('cidades.index', compact('cidades'));
    }

    // FORMULÁRIO DE CRIAÇÃO
    public function create()
    {
        return view('cidades.create');
    }

    // SALVAR NOVA CIDADE
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

    // SHOW DA CIDADE (com usuários e áreas)
    public function show($id)
    {
        $cidade = Cidade::with('areas')->findOrFail($id);

        // Buscar todos os usuários (pode ajustar se tiver relacionamento específico)
        $usuarios = User::all();

        // Se houver busca, captura a query (opcional)
        $search = request('search', '');

        return view('cidades.show', compact('cidade', 'usuarios', 'search'));
        $cidade = Cidade::with('espacos')->findOrFail($id);

        $usuarios = User::all(); // ou filtre como antes
        $search = request('search'); // se estiver usando pesquisa

        return view('cidades.show', compact('cidade', 'usuarios', 'search'));
    }



    // FORMULÁRIO DE EDIÇÃO
    public function edit(Cidade $cidade)
    {
        return view('cidades.edit', compact('cidade'));
    }

    // ATUALIZAR CIDADE
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


    // EXCLUIR CIDADE
    public function destroy(Cidade $cidade)
    {
        $cidade->delete();

        return redirect()->route('cidades.index')
            ->with('success', 'Cidade excluída com sucesso!');
    }

    // BUSCAR USUÁRIOS (API ou AJAX)
    public function buscarUsuarios(Request $request)
    {
        $usuarios = User::where('name', 'like', '%' . $request->busca . '%')
            ->orWhere('email', 'like', '%' . $request->busca . '%')
            ->orWhere('cpf', 'like', '%' . $request->busca . '%')
            ->get();

        return response()->json($usuarios);
    }

    // ADICIONAR USUÁRIO AUTORIZADO
    public function adicionarUsuario(Request $request, Cidade $cidade)
    {
        $cidade->usuarios()->attach($request->usuario_id);

        return redirect()->route('cidades.show', $cidade->id)
            ->with('success', 'Usuário adicionado com sucesso!');
    }
}
