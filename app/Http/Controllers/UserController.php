<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

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

        // 🔥 CORREÇÃO IMPORTANTE (criptografar senha)
        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário criado com sucesso!');
    }

    public function show(User $user)
    {
        // 🔒 só pode ver próprio perfil ou admin
        if (
            auth()->user()->role !== 'super_admin' &&
            auth()->id() !== $user->id
        ) {
            abort(403, 'Acesso negado');
        }

        return view('users.show', compact('user'));
    }

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

        // 🔥 se preencher senha → criptografa
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

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
