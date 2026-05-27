@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: #f5f4f0;
        }

        .page-hero {
            background: #1a1a2e;
            color: #fff;
            padding: 56px 0 40px;
        }

        .page-hero h1 {
            font-family: 'Sora', sans-serif;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .page-hero p {
            color: #a0a0c0;
            font-size: 16px;
            margin: 0;
        }

        .content-wrapper {
            margin-top: -20px;
            padding-bottom: 50px;
        }

        .content-box {
            background: #fff;
            border-radius: 24px 24px 18px 18px;
            padding: 32px;
            box-shadow: 0 -4px 24px rgba(0, 0, 0, 0.08);
        }

        .custom-card {
            border: 1px solid #ececec;
            border-radius: 18px;
            overflow: hidden;
            background: #fff;
            transition: all 0.2s ease;
        }

        .custom-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .custom-card .card-header {
            background: #fafaf8;
            border-bottom: 1px solid #eee;
            padding: 18px 22px;
            font-weight: 600;
            color: #1a1a2e;
        }

        .custom-card .card-body {
            padding: 24px;
        }

        .form-control {
            border-radius: 12px;
            border: 1.5px solid #e0dfd8;
            padding: 14px 16px;
            background: #fafaf8;
        }

        .form-control:focus {
            border-color: #4a4aff;
            box-shadow: 0 0 0 3px rgba(74, 74, 255, 0.1);
            background: #fff;
        }

        .btn-modern {
            border-radius: 12px;
            padding: 10px 18px;
            font-weight: 600;
        }

        .nav-tabs {
            border-bottom: none;
            gap: 8px;
        }

        .nav-tabs .nav-link {
            border: none;
            border-radius: 10px;
            color: #888;
            font-weight: 500;
            padding: 10px 18px;
            transition: all 0.2s ease;
        }

        .nav-tabs .nav-link.active {
            background: #f0f0ff;
            color: #4a4aff;
        }

        .table thead th {
            border-top: none;
            color: #888;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .table tbody td {
            vertical-align: middle;
        }

        .admin-badge {
            background: #f0f0ff;
            color: #4a4aff;
            border-radius: 20px;
            padding: 4px 10px;
            font-size: 12px;
            font-weight: 600;
        }

        .espaco-card {
            border: 1px solid #ececec;
            border-radius: 16px;
            padding: 18px;
            margin-bottom: 16px;
            background: #fafaf8;
            transition: all 0.2s ease;
        }

        .espaco-card:hover {
            background: #fff;
            border-color: #dcdcff;
            box-shadow: 0 6px 18px rgba(74, 74, 255, 0.08);
        }

        .espaco-title {
            font-family: 'Sora', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 6px;
        }

        .espaco-desc {
            color: #777;
            font-size: 14px;
            margin-bottom: 14px;
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #aaa;
        }

        .empty-state .icon {
            font-size: 48px;
            margin-bottom: 10px;
        }

        @media(max-width: 768px) {

            .page-hero {
                padding: 36px 0 24px;
            }

            .page-hero h1 {
                font-size: 28px;
            }

            .content-box {
                padding: 20px;
            }
        }
    </style>

    <div class="page-hero">
        <div class="container">
            <h1>{{ $cidade->nome }}</h1>

            <p>
                Gerencie administradores, espaços e reservas desta cidade.
            </p>
        </div>
    </div>

    <div class="container content-wrapper">

        <div class="content-box">

            @if (session('success'))
                <div class="alert alert-success border-0 rounded-4 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-4 shadow-sm">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @can('inviteAdmins', $cidade)
                <div class="card custom-card mb-4">

                    <div class="card-header">
                        👤 Convidar administrador
                    </div>

                    <div class="card-body">

                        <form action="{{ route('cidades.convites-admin.store', $cidade->id) }}" method="POST">

                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    E-mail do usuário
                                </label>

                                <input type="email" name="email" class="form-control"
                                    placeholder="Digite o e-mail do administrador" required>
                            </div>

                            <button type="submit" class="btn btn-success btn-modern">
                                Enviar convite
                            </button>

                        </form>

                    </div>

                </div>
            @endcan

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

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

                <div class="d-flex gap-2 flex-wrap">

                    @can('create', [App\Models\Espaco::class, $cidade])
                        <a href="{{ route('espacos.create', ['cidade_id' => $cidade->id]) }}"
                            class="btn btn-success btn-modern">

                            + Novo Espaço
                        </a>
                    @endcan

                </div>

            </div>

            <div class="tab-content">

                <div class="tab-pane fade show active" id="administradores">

                    <div class="card custom-card">

                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table align-middle">

                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Tipo</th>
                                            <th width="120">Ação</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse ($cidade->administradores as $admin)
                                            <tr>

                                                <td class="fw-semibold">
                                                    {{ $admin->name }}
                                                </td>

                                                <td>
                                                    {{ $admin->email }}
                                                </td>

                                                <td>
                                                    <span class="admin-badge">
                                                        {{ $admin->tipo }}
                                                    </span>
                                                </td>

                                                <td>

                                                    @can('manageAdmins', $cidade)
                                                        <form method="POST"
                                                            action="{{ route('cidades.removerUsuario', [$cidade->id, $admin->id]) }}">

                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="btn btn-outline-danger btn-sm rounded-3">
                                                                Remover
                                                            </button>

                                                        </form>
                                                    @endcan

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-5">

                                                    Nenhum administrador cadastrado.
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="tab-pane fade" id="espacos">

                    <div class="card custom-card">

                        <div class="card-body">

                            @forelse ($cidade->espacos as $espaco)
                                <div class="espaco-card">

                                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">

                                        <div>

                                            <div class="espaco-title">
                                                {{ $espaco->titulo }}
                                            </div>

                                            <div class="espaco-desc">
                                                {{ $espaco->descricao }}
                                            </div>

                                        </div>

                                        <div class="d-flex gap-2">

                                            @can('update', $espaco)
                                                <a href="{{ route('espacos.edit', $espaco->id) }}"
                                                    class="btn btn-outline-primary btn-sm rounded-3">

                                                    Editar
                                                </a>
                                            @endcan

                                            @can('delete', $espaco)
                                                <form action="{{ route('espacos.destroy', $espaco->id) }}" method="POST">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-outline-danger btn-sm rounded-3">
                                                        Excluir
                                                    </button>

                                                </form>
                                            @endcan

                                        </div>

                                    </div>

                                </div>

                            @empty

                                <div class="empty-state">

                                    <div class="icon">
                                        🏟️
                                    </div>

                                    <p>
                                        Nenhum espaço cadastrado nesta cidade.
                                    </p>

                                </div>
                            @endforelse

                            @can('manageAdmins', $cidade)
                                <a href="{{ route('categorias.index') }}" class="btn btn-outline-success btn-modern mt-3">

                                    📂 Gerenciar Categorias
                                </a>
                            @endcan

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
