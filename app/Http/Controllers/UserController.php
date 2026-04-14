<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('index', User::class);

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
        Gate::authorize('show', $user);

        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        Gate::authorize('edit', $user);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        Gate::authorize('edit', $user);

        $data = $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'cpf'             => ['required', 'string', 'max:14', 'unique:users,cpf,' . $user->id],
            'telefone'        => ['required', 'string', 'max:20'],
            'data_nascimento' => ['required', 'date'],
            'role'            => ['required', 'in:admin,usuario'],
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
        Gate::authorize('delete', $user);

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
