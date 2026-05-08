@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    body { font-family: 'DM Sans', sans-serif; background: #f5f4f0; }

    .page-header {
        background: #1a1a2e;
        color: #fff;
        padding: 40px 0 80px;
        position: relative;
        overflow: hidden;
    }

    .page-header::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 48px;
        background: #f5f4f0;
        border-radius: 48px 48px 0 0;
    }

    .breadcrumb-nav {
        font-size: 13px;
        color: #7070a0;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .breadcrumb-nav a {
        color: #9090c0;
        text-decoration: none;
    }

    .breadcrumb-nav a:hover { color: #fff; }

    .page-header h1 {
        font-family: 'Sora', sans-serif;
        font-size: 34px;
        font-weight: 700;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

    .page-header .meta {
        color: #8080b0;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .users-panel {
        margin-top: 28px;
        background: #fff;
        border: 1.5px solid #e8e7e0;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 14px 36px rgba(0,0,0,0.08);
    }

    .panel-top {
        padding: 20px 24px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .panel-title {
        font-family: 'Sora', sans-serif;
        font-weight: 600;
        color: #1a1a2e;
        margin: 0;
        font-size: 18px;
    }

    .btn-main {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 11px 18px;
        background: #1a1a2e;
        color: #fff;
        border-radius: 12px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all .2s;
        border: none;
    }

    .btn-main:hover {
        background: #4a4aff;
        color: #fff;
        transform: translateY(-2px);
    }

    .table-modern {
        margin: 0;
    }

    .table-modern thead th {
        background: #faf9f5;
        color: #666;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .4px;
        border-bottom: 1px solid #eee;
        padding: 16px 20px;
    }

    .table-modern tbody td {
        padding: 18px 20px;
        vertical-align: middle;
        border-color: #f1f0eb;
    }

    .user-avatar {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        background: linear-gradient(135deg, #e8eaf6, #c5cae9);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4a4aff;
        font-weight: 700;
        font-family: 'Sora', sans-serif;
    }

    .user-name {
        font-family: 'Sora', sans-serif;
        font-size: 15px;
        font-weight: 600;
        color: #1a1a2e;
    }

    .user-email {
        font-size: 13px;
        color: #888;
    }

    .cpf-badge {
        background: #f0f0ff;
        color: #4a4aff;
        border: 1px solid #d9d8ff;
        border-radius: 999px;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-action {
        border-radius: 10px;
        padding: 8px 12px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        border: 1.5px solid #e0dfd8;
        background: #fff;
        color: #555;
        transition: all .2s;
    }

    .btn-action:hover {
        border-color: #4a4aff;
        color: #4a4aff;
        background: #f0f0ff;
    }

    .btn-danger-soft:hover {
        border-color: #ef4444;
        color: #ef4444;
        background: #fff1f1;
    }

    .empty-state {
        text-align: center;
        padding: 70px 20px;
        color: #aaa;
    }

    .empty-state .icon {
        font-size: 54px;
        margin-bottom: 14px;
    }

    .alert-modern {
        border: 1.5px solid #bbf7d0;
        background: #f0fdf4;
        color: #166534;
        border-radius: 16px;
        padding: 14px 18px;
        margin-top: 24px;
    }

    @media(max-width: 640px) {
        .page-header h1 { font-size: 25px; }
        .table-responsive { border-radius: 0 0 22px 22px; }
    }
</style>

<div class="page-header">
    <div class="container">
        <div class="breadcrumb-nav">
            <a href="{{ route('home') }}"><i class="bi bi-house"></i> Início</a>
            <i class="bi bi-chevron-right" style="font-size:11px;"></i>
            <span>Usuários</span>
        </div>

        <h1>Lista de Usuários</h1>

        <div class="meta">
            <span><i class="bi bi-people"></i> {{ $users->count() }} usuário{{ $users->count() != 1 ? 's' : '' }} cadastrado{{ $users->count() != 1 ? 's' : '' }}</span>
            <span><i class="bi bi-shield-check"></i> Gerenciamento do sistema</span>
        </div>
    </div>
</div>

<div class="container">

    @if (session('success'))
        <div class="alert-modern">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="users-panel">
        <div class="panel-top">
            <h2 class="panel-title">Usuários Cadastrados</h2>

            <a href="{{ route('users.create') }}" class="btn-main">
                <i class="bi bi-plus-circle"></i>
                Novo Usuário
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-modern align-middle">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>CPF</th>
                        <th class="text-center" width="220">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="user-name">{{ $user->name }}</div>
                                        <div class="user-email">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="cpf-badge">
                                    <i class="bi bi-credit-card-2-front"></i>
                                    {{ $user->cpf }}
                                </span>
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <a href="{{ route('users.show', $user) }}" class="btn-action">
                                        <i class="bi bi-eye"></i> Ver
                                    </a>

                                    @can('edit', $user)
                                        <a href="{{ route('users.edit', $user) }}" class="btn-action">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>

                                        <form action="{{ route('users.destroy', $user) }}" method="POST"
                                              onsubmit="return confirm('Tem certeza que deseja excluir este usuário?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn-action btn-danger-soft">
                                                <i class="bi bi-trash"></i> Excluir
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">
                                <div class="empty-state">
                                    <div class="icon">👥</div>
                                    <p>Nenhum usuário cadastrado ainda.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
