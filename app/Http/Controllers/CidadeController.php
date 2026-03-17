<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\User;
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

    public function show(Request $request, $id)
    {
        $cidade = Cidade::with(['areas','usuarios'])->findOrFail($id);
        $search = $request->search;

        $usuarios = [];

        if ($search) {

            $usuarios = User::where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('cpf', 'like', "%{$search}%")
                ->get();
        }

        return view('cidades.show', compact(
            'cidade',
            'usuarios',
            'search'
        ));
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

    public function buscarUsuarios(Request $request)
    {
        $usuarios = User::where('name','like','%'.$request->busca.'%')
            ->orWhere('email','like','%'.$request->busca.'%')
            ->orWhere('cpf','like','%'.$request->busca.'%')
            ->get();

        return response()->json($usuarios);
    }

    public function adicionarUsuario(Request $request, $cidade_id)
    {
        $request->validate([
            'usuario_id' => 'required|exists:users,id'
        ]);

        $cidade = Cidade::findOrFail($cidade_id);

        $cidade->usuarios()->syncWithoutDetaching([
            $request->usuario_id
        ]);

        return back()->with('success','Usuário adicionado com sucesso');
    }

}
