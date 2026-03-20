<!-- resources/views/cidades/show.blade.php -->
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

        .nav-tabs .nav-link {
            font-weight: 600;
        }

        .btn-categorias {
            margin-top: 15px;
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

        <!-- TABS -->
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#usuarios">
                    👥 Usuários Autorizados
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#areas">
                    🏟 Áreas da Cidade
                </button>
            </li>
        </ul>

        <div class="tab-content">

            <!-- USUÁRIOS -->
            <div class="tab-pane fade show active" id="usuarios">
                <div class="card card-painel">
                    <div class="card-body">

                        <h5 class="mb-3">Pesquisar Usuário</h5>
                        <h6 class="small">
                            Adicione ou remova usuários que podem configurar e aprovar reservas
                        </h6>

                        <form method="GET" action="{{ route('cidades.show', $cidade->id) }}">
                            <div class="row mb-4">
                                <div class="col-md-9">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Digite nome, email ou CPF" value="{{ $search }}">
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-success w-100">
                                        🔎 Pesquisar
                                    </button>
                                </div>
                            </div>
                        </form>

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
                                                <form method="POST"
                                                    action="{{ route('cidades.adicionarUsuario', $cidade->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">
                                                    <button class="btn btn-success btn-sm">Adicionar</button>
                                                </form>
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

            <!-- ÁREAS -->
            <div class="tab-pane fade" id="areas">
                <div class="card card-painel">
                    <div class="card-body">
                        <h5 class="mb-3">Categorias cadastradas</h5>

                        @forelse($cidade->espacos as $espaco)
                            <div class="mb-4">
                                <h6>📍 {{ $espaco->titulo }}</h6>
                                <p>{{ $espaco->descricao }}</p>
                                <a href="{{ route('espacos.edit', $espaco->id) }}" class="btn btn-sm btn-primary">
                                    Editar
                                </a>
                            </div>
                        @empty
                            <p class="text-muted">Nenhuma categoria cadastrada</p>
                        @endforelse

                        <!-- BOTÃO DE CATEGORIAS -->
                        <a href="{{ route('categorias.index', $cidade->id) }}" class="btn btn-success btn-sm btn-categorias">
                            📂 Gerenciar Categorias
                        </a>

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
