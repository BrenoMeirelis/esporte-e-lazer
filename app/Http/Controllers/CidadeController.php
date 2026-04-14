<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CidadeController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('index', Cidade::class);

        $cidades = Cidade::all();
        return view('cidades.index', compact('cidades'));
    }

    public function create()
    {
        $this->authorize('create', Cidade::class);

        return view('cidades.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Cidade::class);

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
        $this->authorize('show', $cidade);

        $cidade->load('espacos');

        $usuarios = User::all();
        $search = request('search', '');

        return view('cidades.show', compact('cidade', 'usuarios', 'search'));
    }

    public function edit(Cidade $cidade)
    {
        $this->authorize('update', $cidade);

        return view('cidades.edit', compact('cidade'));
    }

    public function update(Request $request, Cidade $cidade)
    {
        $this->authorize('update', $cidade);

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
        $this->authorize('delete', $cidade);

        $cidade->delete();

        return redirect()->route('cidades.index')
            ->with('success', 'Cidade excluída com sucesso!');
    }

    public function buscarUsuarios(Request $request)
    {
        $this->authorize('index', User::class);

        $usuarios = User::where('name', 'like', '%' . $request->busca . '%')
            ->orWhere('email', 'like', '%' . $request->busca . '%')
            ->orWhere('cpf', 'like', '%' . $request->busca . '%')
            ->get();

        return response()->json($usuarios);
    }

    public function adicionarUsuario(Request $request, Cidade $cidade)
    {
        $this->authorize('update', $cidade);

        $cidade->usuarios()->attach($request->usuario_id);

        return redirect()->route('cidades.show', $cidade->id)
            ->with('success', 'Usuário adicionado com sucesso!');
    }

    public function buscar(Request $request)
    {
        $query = $request->q;

        $cidades = Cidade::where('nome', 'like', "%$query%")->get();

        return view('cidades.busca', compact('cidades'));
    }
}
