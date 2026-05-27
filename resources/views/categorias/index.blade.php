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

        .table-card {
            border: 1px solid #ececec;
            border-radius: 18px;
            overflow: hidden;
            background: #fff;
        }

        .table-card-header {
            background: #fafaf8;
            border-bottom: 1px solid #eee;
            padding: 20px 24px;
            font-weight: 600;
            color: #1a1a2e;
            font-size: 16px;
        }

        .table-card-body {
            padding: 24px;
        }

        .section-label {
            font-family: 'Sora', sans-serif;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.5px;
            color: #aaa;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .table thead th {
            border-top: none;
            color: #888;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            background: #fafaf8;
        }

        .table tbody td {
            vertical-align: middle;
        }

        .category-badge {
            background: #f0f0ff;
            color: #4a4aff;
            border-radius: 20px;
            padding: 5px 12px;
            font-size: 13px;
            font-weight: 600;
        }

        .btn-modern {
            border-radius: 12px;
            padding: 10px 18px;
            font-weight: 600;
        }

        .btn-action {
            border-radius: 10px;
            font-weight: 600;
        }

        .alert-success {
            background: #e8f8f0;
            border: 1px solid #b5e8d0;
            color: #1a7a50;
            border-radius: 12px;
            padding: 12px 18px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
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

            .table-card-body {
                padding: 18px;
            }
        }
    </style>

    <div class="page-hero">
        <div class="container">
            <h1>Categorias 📂</h1>

            <p>
                Gerencie as categorias disponíveis para os espaços públicos.
            </p>
        </div>
    </div>

    <div class="container content-wrapper">

        <div class="content-box">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

                <div>
                    <p class="section-label mb-0">
                        {{ $categorias->count() }}
                        categoria{{ $categorias->count() != 1 ? 's' : '' }}
                        cadastrada{{ $categorias->count() != 1 ? 's' : '' }}
                    </p>
                </div>

                <div class="d-flex gap-2 flex-wrap">

                    @isset($cidade)
                        @if (Route::has('cidades.show'))
                            <a href="{{ route('cidades.show', $cidade->id) }}" class="btn btn-outline-secondary btn-modern">
                                ← Voltar
                            </a>
                        @endif
                    @else
                        @if (Route::has('cidades.index'))
                            <a href="{{ route('cidades.index') }}" class="btn btn-outline-secondary btn-modern">
                                ← Voltar
                            </a>
                        @endif
                    @endisset

                    @if (Route::has('categorias.create'))
                        <a href="{{ route('categorias.create') }}" class="btn btn-success btn-modern">
                            + Nova Categoria
                        </a>
                    @endif

                </div>

            </div>

            @if (session('success'))
                <div class="alert-success">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-card">

                <div class="table-card-header">
                    📋 Lista de categorias
                </div>

                <div class="table-card-body">

                    @if ($categorias->isEmpty())
                        <div class="empty-state">
                            <div class="icon">
                                📂
                            </div>

                            <p>
                                Nenhuma categoria cadastrada.
                            </p>
                        </div>
                    @else
                        <div class="table-responsive">

                            <table class="table align-middle mb-0">

                                <thead>
                                    <tr>
                                        <th width="90">ID</th>
                                        <th>Nome</th>
                                        <th width="240" class="text-center">Ações</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($categorias as $categoria)
                                        <tr>

                                            <td>
                                                <span class="category-badge">
                                                    #{{ $categoria->id }}
                                                </span>
                                            </td>

                                            <td class="fw-semibold">
                                                {{ $categoria->nome }}
                                            </td>

                                            <td class="text-center">

                                                <div class="d-flex justify-content-center gap-2 flex-wrap">

                                                    @if (Route::has('categorias.show'))
                                                        <a href="{{ route('categorias.show', $categoria->id) }}"
                                                            class="btn btn-outline-info btn-sm btn-action">
                                                            Ver
                                                        </a>
                                                    @endif

                                                    @if (Route::has('categorias.edit'))
                                                        <a href="{{ route('categorias.edit', $categoria->id) }}"
                                                            class="btn btn-outline-warning btn-sm btn-action">
                                                            Editar
                                                        </a>
                                                    @endif

                                                    @if (Route::has('categorias.destroy'))
                                                        <form action="{{ route('categorias.destroy', $categoria->id) }}"
                                                            method="POST">

                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-sm btn-action"
                                                                onclick="return confirm('Tem certeza que deseja excluir?')">
                                                                Excluir
                                                            </button>

                                                        </form>
                                                    @endif

                                                </div>

                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>
                    @endif

                </div>

            </div>

        </div>

    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
