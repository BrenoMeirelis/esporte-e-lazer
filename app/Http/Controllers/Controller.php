<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}

public function index()
{
    $users = User::all();
    return view('users.index', compact('users'));
}

public function create()
{
    return view('users.create');
}

public function store(Request $request)
{
    $dados = $request->validate([
        'nome' => 'required',
        'sobrenome' => 'required',
        'cpf' => 'required|unique:users',
        'telefone' => 'nullable',
        'data_nascimento' => 'required|date',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
    ]);

    $dados['password'] = bcrypt($dados['password']);

    User::create($dados);

    return redirect()->route('users.index');
}

public function show(User $user)
{
    return view('users.show', compact('user'));
}

public function edit(User $user)
{
    return view('users.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    $dados = $request->validate([
        'nome' => 'required',
        'sobrenome' => 'required',
        'cpf' => 'required|unique:users,cpf,' . $user->id,
        'telefone' => 'nullable',
        'data_nascimento' => 'required|date',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $user->update($dados);

    return redirect()->route('users.index');
}

public function destroy(User $user)
{
    $user->delete();
    return redirect()->route('users.index');
}
