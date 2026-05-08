@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: #f5f4f0;
        }

        .profile-header {
            background: #1a1a2e;
            color: #fff;
            padding: 40px 0 90px;
            position: relative;
            overflow: hidden;
        }

        .profile-header::after {
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

        .breadcrumb-nav a:hover {
            color: #fff;
        }

        .profile-header h1 {
            font-family: 'Sora', sans-serif;
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .profile-header .meta {
            color: #8080b0;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .profile-card {
            margin-top: 30px;
            background: #fff;
            border: 1.5px solid #e8e7e0;
            border-radius: 24px;
            box-shadow: 0 14px 36px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .profile-top {
            padding: 28px;
            display: flex;
            align-items: center;
            gap: 20px;
            border-bottom: 1px solid #eee;
            background: linear-gradient(135deg, #ffffff, #f7f7ff);
        }

        .avatar-large {
            width: 78px;
            height: 78px;
            border-radius: 24px;
            background: linear-gradient(135deg, #e8eaf6, #c5cae9);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4a4aff;
            font-size: 30px;
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            flex-shrink: 0;
        }

        .profile-name {
            font-family: 'Sora', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: #1a1a2e;
            margin: 0 0 6px;
        }

        .profile-email {
            color: #888;
            font-size: 14px;
            margin: 0;
        }

        .profile-body {
            padding: 28px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
        }

        .info-box {
            border: 1.5px solid #e8e7e0;
            background: #fff;
            border-radius: 18px;
            padding: 18px;
        }

        .info-label {
            color: #888;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .4px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .info-value {
            color: #1a1a2e;
            font-weight: 600;
            font-size: 15px;
            word-break: break-word;
        }

        .actions-bar {
            padding: 22px 28px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
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

        .btn-soft {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 11px 18px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all .2s;
            border: 1.5px solid #e0dfd8;
            background: #fff;
            color: #555;
        }

        .btn-soft:hover {
            border-color: #4a4aff;
            color: #4a4aff;
            background: #f0f0ff;
        }

        .btn-danger-soft:hover {
            border-color: #ef4444;
            color: #ef4444;
            background: #fff1f1;
        }

        @media(max-width: 640px) {
            .profile-header h1 {
                font-size: 25px;
            }

            .profile-top {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>

    <div class="profile-header">
        <div class="container">
            <div class="breadcrumb-nav">
                <a href="{{ route('users.index') }}"><i class="bi bi-people"></i> Usuários</a>
                <i class="bi bi-chevron-right" style="font-size:11px;"></i>
                <span>Perfil</span>
            </div>

            <h1>Perfil do Usuário</h1>

            <div class="meta">
                <span><i class="bi bi-person-badge"></i> Dados cadastrais</span>
                <span><i class="bi bi-shield-check"></i> Informações do sistema</span>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="profile-card">

            <div class="profile-top">
                <div class="avatar-large">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div>
                    <h2 class="profile-name">{{ $user->name }}</h2>
                    <p class="profile-email">
                        <i class="bi bi-envelope"></i>
                        {{ $user->email }}
                    </p>
                </div>
            </div>

            <div class="profile-body">
                <div class="info-grid">

                    <div class="info-box">
                        <div class="info-label">
                            <i class="bi bi-credit-card-2-front"></i>
                            CPF
                        </div>
                        <div class="info-value">{{ $user->cpf }}</div>
                    </div>

                    <div class="info-box">
                        <div class="info-label">
                            <i class="bi bi-telephone"></i>
                            Telefone
                        </div>
                        <div class="info-value">{{ $user->telefone ?? 'Não informado' }}</div>
                    </div>

                    <div class="info-box">
                        <div class="info-label">
                            <i class="bi bi-calendar-event"></i>
                            Nascimento
                        </div>
                        <div class="info-value">{{ $user->data_nascimento ?? 'Não informado' }}</div>
                    </div>

                    <div class="info-box">
                        <div class="info-label">
                            <i class="bi bi-person-gear"></i>
                            Tipo
                        </div>
                        <div class="info-value">
                            {{ ucfirst($user->tipo ?? 'usuário') }}
                        </div>
                    </div>

                </div>
            </div>

            <div class="actions-bar">
                <a href="{{ route('users.index') }}" class="btn-soft">
                    <i class="bi bi-arrow-left"></i>
                    Voltar
                </a>

                @can('edit', $user)
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('users.edit', $user) }}" class="btn-main">
                            <i class="bi bi-pencil"></i>
                            Editar Perfil
                        </a>

                        <form action="{{ route('users.destroy', $user) }}" method="POST"
                            onsubmit="return confirm('Tem certeza que deseja excluir este perfil?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn-soft btn-danger-soft">
                                <i class="bi bi-trash"></i>
                                Excluir Perfil
                            </button>
                        </form>
                    </div>
                @endcan
            </div>

        </div>
    </div>
@endsection
