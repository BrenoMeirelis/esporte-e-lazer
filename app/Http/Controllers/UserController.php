<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Lista todos os usuários.
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }

    /**
     * Exibe o formulário de criação.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Armazena um novo usuário.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'cpf'             => ['required', 'string', 'max:14', 'unique:users,cpf'],
            'telefone'        => ['required', 'string', 'max:20'],
            'data_nascimento' => ['required', 'date'],
            'tipo'            => ['required', 'in:admin,usuario'],
            'email'           => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'        => ['required', 'min:6', 'confirmed'],
        ]);

        User::create($data);

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário criado com sucesso!');
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Atualiza o usuário.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'cpf'             => ['required', 'string', 'max:14', 'unique:users,cpf,' . $user->id],
            'telefone'        => ['required', 'string', 'max:20'],
            'data_nascimento' => ['required', 'date'],
            'tipo'            => ['required', 'in:admin,usuario'],
            'email'           => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password'        => ['nullable', 'min:6', 'confirmed'],
        ]);

        // Remove senha se não for preenchida
        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove o usuário.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário excluído com sucesso!');
    }
}
