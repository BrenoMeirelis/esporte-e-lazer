@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="card border-0 shadow-lg rounded-4">

        {{-- HEADER --}}
        <div class="card-header text-white rounded-top-4"
            style="background: linear-gradient(135deg, #4f46e5, #9333ea);">
            <strong>Perfil do Usuário</strong>
        </div>

        <div class="card-body p-4">

            <h3 class="fw-bold mb-3">
                {{ $user->name }}
            </h3>

            <div class="mb-2">
                <strong>CPF:</strong>
                <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
                    {{ $user->cpf }}
                </span>
            </div>

            <div class="mb-2">
                <strong>Telefone:</strong>
                <span class="text-muted">{{ $user->telefone }}</span>
            </div>

            <div class="mb-2">
                <strong>Nascimento:</strong>
                <span class="text-muted">{{ $user->data_nascimento }}</span>
            </div>

            <div class="mb-3">
                <strong>Email:</strong>
                <span class="text-muted">{{ $user->email }}</span>
            </div>

            {{-- AÇÕES --}}
            <div class="d-flex gap-2 mt-4">

                @can('edit', $user)
                    <a href="{{ route('users.edit', $user) }}"
                        class="btn btn-outline-warning rounded-pill px-4">
                        ✏ Editar Perfil
                    </a>

                    <form action="{{ route('users.destroy', $user) }}" method="POST"
                        onsubmit="return confirm('Tem certeza que deseja excluir seu perfil?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="btn btn-outline-danger rounded-pill px-4">
                            🗑 Excluir Perfil
                        </button>
                    </form>
                @endcan

            </div>

        </div>
    </div>

</div>
@endsection
