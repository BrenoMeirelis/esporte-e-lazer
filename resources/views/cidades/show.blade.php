@extends('layouts.app')

@section('content')
<style>
.hero-cidade {
    background-color: #198754;
    color: white;
    padding: 40px 20px;
    border-radius: 15px;
    text-align: center;
    margin-bottom: 35px;
}
</style>

<div class="container mt-4">

    <div class="hero-cidade">
        <h1>{{ $cidade->nome }}</h1>
        <p>Gerencie usuários autorizados e áreas cadastradas desta cidade.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#usuarios">
                    👥 Usuários
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#areas">
                    🏟 Espaços
                </button>
            </li>
        </ul>

        @auth
            @if (in_array(auth()->user()->tipo, ['admin', 'super_admin']))
                <a href="{{ route('espacos.create', ['cidade_id' => $cidade->id]) }}" class="btn btn-success btn-sm">
                    + Novo Espaço
                </a>
            @endif
        @endauth

    </div>

    <div class="tab-content">

        <!-- USUÁRIOS -->
        <div class="tab-pane fade show active" id="usuarios">
            <div class="card">
                <div class="card-body">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>CPF</th>
                                <th>Ação</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->cpf }}</td>

                                    <td>
                                        @auth
                                            @if (in_array(auth()->user()->tipo, ['admin', 'super_admin']))
                                                <form method="POST"
                                                    action="{{ route('cidades.adicionarUsuario', $cidade->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">
                                                    <button class="btn btn-success btn-sm">
                                                        Adicionar
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted">Sem permissão</span>
                                            @endif
                                        @endauth
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <!-- ESPAÇOS -->
        <div class="tab-pane fade" id="areas">
            <div class="card">
                <div class="card-body">

                    @foreach($cidade->espacos as $espaco)
                        <div class="mb-3">
                            <h6>{{ $espaco->titulo }}</h6>
                            <p>{{ $espaco->descricao }}</p>

                            @auth
                                @if (in_array(auth()->user()->tipo, ['admin', 'super_admin']))
                                    <a href="{{ route('espacos.edit', $espaco->id) }}"
                                        class="btn btn-primary btn-sm">
                                        Editar
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endforeach

                    @auth
                        @if (in_array(auth()->user()->tipo, ['admin', 'super_admin']))
                            <a href="{{ route('categorias.index') }}"
                                class="btn btn-outline-success btn-sm mt-3">
                                📂 Gerenciar Categorias
                            </a>
                        @endif
                    @endauth

                </div>
            </div>
        </div>

    </div>

</div>
@endsection
