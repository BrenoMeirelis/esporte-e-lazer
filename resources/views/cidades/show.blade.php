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

        .hero-cidade h1 {
            font-size: 34px;
            font-weight: 700;
        }

        .hero-cidade p {
            font-size: 18px;
        }

        .card-painel {
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .card-painel:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .table td {
            vertical-align: middle;
        }
    </style>

    <div class="container mt-4">

        <!-- HERO -->
        <div class="hero-cidade">
            <h1>{{ $cidade->nome }}</h1>
            <p>Gerencie usuários autorizados e áreas cadastradas desta cidade.</p>
        </div>

        <!-- ALERTA -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">

            <!-- TABS -->
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

            <!-- 🔥 BOTÃO SÓ ADMIN -->
            @auth
                @if (in_array(auth()->user()->role, ['admin', 'super_admin']))
                    <a href="{{ route('espacos.create', ['cidade_id' => $cidade->id]) }}" class="btn btn-success btn-sm">
                        + Novo Espaço
                    </a>
                @endif
            @endauth

        </div>

        <div class="tab-content">

            <!-- USUÁRIOS -->
            <div class="tab-pane fade show active" id="usuarios">
                <div class="card card-painel">
                    <div class="card-body">

                        <h5 class="mb-3">Usuários</h5>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>CPF</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->name }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            <td>{{ $usuario->cpf }}</td>

                                            <td>
                                                @auth
                                                    @if (in_array(auth()->user()->role, ['admin', 'super_admin']))
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
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">
                                                Nenhum usuário encontrado
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <!-- ESPAÇOS -->
            <div class="tab-pane fade" id="areas">
                <div class="card card-painel">
                    <div class="card-body">

                        <h5 class="mb-3">Espaços cadastrados</h5>

                        @forelse($cidade->espacos as $espaco)
                            <div class="mb-4">
                                <h6>📍 {{ $espaco->titulo }}</h6>
                                <p>{{ $espaco->descricao }}</p>

                                <!-- 🔥 EDITAR SÓ ADMIN -->
                                @auth
                                    @if (in_array(auth()->user()->role, ['admin', 'super_admin']))
                                        <a href="{{ route('espacos.edit', $espaco->id) }}" class="btn btn-sm btn-primary">
                                            Editar
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        @empty
                            <p class="text-muted">Nenhum espaço cadastrado</p>
                        @endforelse

                        <!-- 🔥 CATEGORIA SÓ ADMIN -->
                        @auth
                            @if (in_array(auth()->user()->role, ['admin', 'super_admin']))
                                <a href="{{ route('categorias.index', ['cidade' => $cidade->id]) }}"
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
