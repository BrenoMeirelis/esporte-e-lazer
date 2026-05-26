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
            <p>Gerencie administradores e espaços cadastrados desta cidade.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @can('inviteAdmins', $cidade)
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Convidar administrador da cidade</strong>
                </div>

                <div class="card-body">
                    <form action="{{ route('cidades.convites-admin.store', $cidade->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">E-mail do usuário</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Enviar convite
                        </button>
                    </form>
                </div>
            </div>
        @endcan

        <div class="d-flex justify-content-between align-items-center mb-3">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#administradores">
                        👥 Administradores
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#espacos">
                        🏟 Espaços
                    </button>
                </li>
            </ul>

            @can('create', [App\Models\Espaco::class, $cidade])
                <a href="{{ route('espacos.create', ['cidade_id' => $cidade->id]) }}" class="btn btn-success btn-sm">
                    + Novo Espaço
                </a>
            @endcan
        </div>

        @can('manageAdmins', $cidade)
            <a href="{{ route('cidades.calendario', $cidade->id) }}" class="btn btn-dark mb-3">
                <i class="bi bi-calendar-event-fill"></i>
                Controle de Reservas
            </a>
        @endcan

        <div class="tab-content">

            <div class="tab-pane fade show active" id="administradores">
                <div class="card">
                    <div class="card-body">

                        <h5 class="mb-3">Administradores desta cidade</h5>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Tipo</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($cidade->administradores as $admin)
                                    <tr>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->tipo }}</td>
                                        <td>
                                            @can('manageAdmins', $cidade)
                                                <form method="POST"
                                                    action="{{ route('cidades.removerUsuario', [$cidade->id, $admin->id]) }}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm">
                                                        Remover
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-muted text-center">
                                            Nenhum administrador cadastrado nesta cidade.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="espacos">
                <div class="card">
                    <div class="card-body">

                        @forelse ($cidade->espacos as $espaco)
                            <div class="border-bottom pb-3 mb-3">
                                <h6>{{ $espaco->titulo }}</h6>
                                <p>{{ $espaco->descricao }}</p>

                                @can('update', $espaco)
                                    <a href="{{ route('espacos.edit', $espaco->id) }}" class="btn btn-primary btn-sm">
                                        Editar
                                    </a>
                                @endcan

                                @can('delete', $espaco)
                                    <form action="{{ route('espacos.destroy', $espaco->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">
                                            Excluir
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        @empty
                            <p class="text-muted">
                                Nenhum espaço cadastrado nesta cidade.
                            </p>
                        @endforelse

                        @can('manageAdmins', $cidade)
                            <a href="{{ route('categorias.index') }}" class="btn btn-outline-success btn-sm mt-3">
                                📂 Gerenciar Categorias
                            </a>
                        @endcan

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
