@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Lista de Usuários</h2>
            <small class="text-muted">Gerencie os usuários do sistema</small>
        </div>

        <a href="{{ route('users.create') }}"
            class="btn text-white rounded-pill px-4 shadow-sm"
            style="background: linear-gradient(135deg, #0ea5e9, #6366f1); border: none;">
            + Novo Usuário
        </a>
    </div>

    {{-- Sucesso --}}
    @if(session('success'))
        <div class="alert alert-success rounded-3 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-lg rounded-4">

        {{-- Header com gradiente --}}
        <div class="card-header text-white rounded-top-4"
                style="background: linear-gradient(135deg, #4f46e5, #9333ea);">
            <strong>Usuários Cadastrados</strong>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table align-middle mb-0">

                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3">Nome</th>
                            <th>Email</th>
                            <th>CPF</th>
                            <th class="text-center" width="200">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-top">

                                <td class="px-4 fw-semibold">
                                    {{ $user->name }}
                                </td>

                                <td>
                                    <span class="text-muted">
                                        {{ $user->email }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
                                        {{ $user->cpf }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="{{ route('users.edit', $user) }}"
                                            class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                            ✏ Editar
                                        </a>

                                        <form action="{{ route('users.destroy', $user) }}"
                                                method="POST"
                                                onsubmit="return confirm('Tem certeza que deseja excluir este usuário?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                🗑 Excluir
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    Nenhum usuário cadastrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

@endsection
