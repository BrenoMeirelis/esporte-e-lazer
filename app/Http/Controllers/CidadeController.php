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
        $cidades = Cidade::all();

        return view('cidades.index', compact('cidades'));
    }

    public function create()
    {
        return view('cidades.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cep' => ['required', 'string', 'max:20'],
            'uf' => ['required', 'string', 'max:2'],
            'email' => ['nullable', 'email', 'max:255'],
        ]);

        Cidade::create($dados);

        return redirect()
            ->route('cidades.index')
            ->with('success', 'Cidade cadastrada com sucesso!');
    }

    public function show(Cidade $cidade)
    {
        $this->authorize('show', $cidade);

        $cidade->load([
            'espacos',
            'administradores',
        ]);

        $usuarios = User::whereIn('tipo', ['admin', 'super_admin'])
            ->orderBy('name')
            ->get();

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

        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cep' => ['required', 'string', 'max:20'],
            'uf' => ['required', 'string', 'max:2'],
            'email' => ['nullable', 'email', 'max:255'],
        ]);

        $cidade->update($dados);

        return redirect()
            ->route('cidades.index')
            ->with('success', 'Cidade atualizada com sucesso!');
    }

    public function destroy(Cidade $cidade)
    {
        $this->authorize('delete', $cidade);

        $cidade->delete();

        return redirect()
            ->route('cidades.index')
            ->with('success', 'Cidade excluída com sucesso!');
    }

    public function buscarUsuarios(Request $request)
    {
        $busca = $request->input('busca');

        $usuarios = User::whereIn('tipo', ['admin', 'super_admin'])
            ->where(function ($query) use ($busca) {
                $query->where('name', 'like', '%' . $busca . '%')
                    ->orWhere('email', 'like', '%' . $busca . '%')
                    ->orWhere('cpf', 'like', '%' . $busca . '%');
            })
            ->orderBy('name')
            ->get();

        return response()->json($usuarios);
    }

    public function buscar(Request $request)
    {
        $query = $request->input('q');

        $cidades = Cidade::where('nome', 'like', '%' . $query . '%')
            ->orderBy('nome')
            ->get();

        return view('cidades.busca', compact('cidades'));
    }

    public function adicionarUsuario(Request $request, Cidade $cidade)
    {
        $this->authorize('manageAdmins', $cidade);

        $dados = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $user = User::findOrFail($dados['user_id']);

        if (! in_array($user->tipo, ['admin', 'super_admin'])) {
            return back()->withErrors([
                'user_id' => 'Somente usuários administradores podem ser vinculados à cidade.',
            ]);
        }

        $cidade->administradores()->syncWithoutDetaching([
            $user->id,
        ]);

        return back()->with('success', 'Administrador adicionado à cidade.');
    }

    public function removerUsuario(Cidade $cidade, User $user)
    {
        $this->authorize('manageAdmins', $cidade);

        $cidade->administradores()->detach($user->id);

        return back()->with('success', 'Administrador removido da cidade.');
    }
}
