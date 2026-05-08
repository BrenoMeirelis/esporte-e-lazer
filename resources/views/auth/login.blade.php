@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: #f5f4f0;
        }

        .login-header {
            background: #1a1a2e;
            color: #fff;
            padding: 50px 0 90px;
            position: relative;
            overflow: hidden;
        }

        .login-header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 48px;
            background: #f5f4f0;
            border-radius: 48px 48px 0 0;
        }

        .login-header h1 {
            font-family: 'Sora', sans-serif;
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: -1px;
        }

        .login-header p {
            color: #9090c0;
            margin: 0;
            font-size: 16px;
        }

        .login-card {
            background: #fff;
            border-radius: 28px;
            border: 1.5px solid #e8e7e0;
            padding: 40px;
            box-shadow: 0 16px 40px rgba(0, 0, 0, .08);
            margin-top: -40px;
            position: relative;
            z-index: 10;
        }

        .login-icon {
            width: 84px;
            height: 84px;
            border-radius: 24px;
            background: #f0f0ff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 38px;
            color: #4a4aff;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #666;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 16px;
            border: 1.5px solid #e5e5e5;
            padding: 14px 18px;
            font-size: 14px;
            transition: .2s;
        }

        .form-control:focus {
            border-color: #4a4aff;
            box-shadow: none;
        }

        .input-group-modern {
            position: relative;
        }

        .input-group-modern i {
            position: absolute;
            top: 50%;
            left: 16px;
            transform: translateY(-50%);
            color: #999;
            z-index: 5;
        }

        .input-group-modern .form-control {
            padding-left: 46px;
        }

        .btn-main {
            width: 100%;
            background: #1a1a2e;
            color: #fff;
            border: none;
            border-radius: 16px;
            padding: 14px;
            font-size: 15px;
            font-weight: 600;
            transition: .2s;
        }

        .btn-main:hover {
            background: #4a4aff;
            transform: translateY(-2px);
        }

        .btn-soft {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            margin-top: 14px;
            padding: 14px;
            border-radius: 16px;
            border: 1.5px solid #e5e5e5;
            background: #fff;
            color: #555;
            text-decoration: none;
            transition: .2s;
        }

        .btn-soft:hover {
            border-color: #4a4aff;
            color: #4a4aff;
            background: #f0f0ff;
        }

        .alert-modern {
            border: none;
            border-radius: 16px;
            font-size: 14px;
        }

        .login-footer {
            text-align: center;
            margin-top: 22px;
            color: #999;
            font-size: 13px;
        }

        @media(max-width:768px) {

            .login-header h1 {
                font-size: 32px;
            }

            .login-card {
                padding: 28px;
            }

        }
    </style>

    <div class="login-header">

        <div class="container text-center">

            <h1>
                Bem-vindo 👋
            </h1>

            <p>
                Faça login para acessar o sistema de reservas.
            </p>

        </div>

    </div>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-5 col-md-7">

                <div class="login-card">

                    <div class="login-icon">
                        <i class="bi bi-person-lock"></i>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-modern mb-4">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">

                        @csrf

                        <div class="mb-4">

                            <label class="form-label">
                                E-mail
                            </label>

                            <div class="input-group-modern">

                                <i class="bi bi-envelope"></i>

                                <input type="email" name="email" class="form-control" placeholder="Digite seu e-mail"
                                    maxlength="120" autocomplete="email" value="{{ old('email') }}" required>

                            </div>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Senha
                            </label>

                            <div class="input-group-modern">

                                <i class="bi bi-shield-lock"></i>

                                <input type="password" name="password" class="form-control" placeholder="Digite sua senha"
                                    minlength="8" maxlength="30" autocomplete="current-password" required>

                            </div>

                        </div>

                        <button type="submit" class="btn-main">

                            <i class="bi bi-box-arrow-in-right"></i>
                            Entrar no Sistema

                        </button>

                        <a href="{{ route('home') }}" class="btn-soft">

                            <i class="bi bi-arrow-left"></i>
                            Voltar para Home

                        </a>

                    </form>

                    <div class="login-footer">

                        Sistema de Reservas Públicas

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
