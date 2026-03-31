<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
        if (
            auth()->user()->role !== 'super_admin' &&
            auth()->id() !== $user->id
        ) {
            abort(403, 'Acesso negado');
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Atualiza o usuário.
     */
    public function update(Request $request, User $user)
    {

        if (
            auth()->user()->role !== 'super_admin' &&
            auth()->id() !== $user->id
        ) {
            abort(403, 'Acesso negado');
        }

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
        if (
            auth()->user()->role !== 'super_admin' &&
            auth()->id() !== $user->id
        ) {
            abort(403, 'Acesso negado');
        }

        $isOwnAccount = auth()->id() === $user->id;

        $user->delete();

        if ($isOwnAccount) {
            Auth::logout();
            return redirect('/login')->with('success', 'Conta excluída com sucesso!');
        }

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário excluído com sucesso!');
    }
}
