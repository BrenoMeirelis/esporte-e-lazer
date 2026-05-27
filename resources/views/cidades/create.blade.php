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

        .form-card {
            border: 1px solid #ececec;
            border-radius: 18px;
            overflow: hidden;
            background: #fff;
        }

        .form-card-header {
            background: #fafaf8;
            border-bottom: 1px solid #eee;
            padding: 20px 24px;
            font-weight: 600;
            color: #1a1a2e;
            font-size: 16px;
        }

        .form-card-body {
            padding: 28px;
        }

        .form-label {
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 12px;
            border: 1.5px solid #e0dfd8;
            padding: 14px 16px;
            background: #fafaf8;
            transition: all 0.2s ease;
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

        .alert-danger {
            border-radius: 14px;
            border: none;
            box-shadow: 0 4px 16px rgba(220, 53, 69, 0.08);
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

            .form-card-body {
                padding: 20px;
            }
        }
    </style>

    <div class="page-hero">
        <div class="container">

            <h1>Nova Cidade 🏙️</h1>

            <p>
                Cadastre uma nova cidade para gerenciamento de espaços e reservas.
            </p>

        </div>
    </div>

    <div class="container content-wrapper">

        <div class="content-box">

            @if ($errors->any())
                <div class="alert alert-danger mb-4">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach

                    </ul>

                </div>
            @endif

            <div class="form-card">

                <div class="form-card-header">
                    📍 Informações da cidade
                </div>

                <div class="form-card-body">

                    <form action="{{ route('cidades.store') }}"
                        method="POST">

                        @csrf

                        <div class="row">

                            <div class="col-md-6 mb-4">

                                <label class="form-label">
                                    Nome da cidade
                                </label>

                                <input type="text"
                                    name="nome"
                                    class="form-control"
                                    placeholder="Digite o nome da cidade"
                                    value="{{ old('nome') }}"
                                    required>

                            </div>

                            <div class="col-md-6 mb-4">

                                <label class="form-label">
                                    CEP
                                </label>

                                <input type="text"
                                    name="cep"
                                    class="form-control"
                                    placeholder="00000-000"
                                    value="{{ old('cep') }}"
                                    required>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-4">

                                <label class="form-label">
                                    UF
                                </label>

                                <input type="text"
                                    name="uf"
                                    maxlength="2"
                                    class="form-control text-uppercase"
                                    placeholder="SP"
                                    value="{{ old('uf') }}"
                                    required>

                            </div>

                            <div class="col-md-8 mb-4">

                                <label class="form-label">
                                    E-mail responsável
                                </label>

                                <input type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="email@exemplo.com"
                                    value="{{ old('email') }}"
                                    required>

                            </div>

                        </div>

                        <div class="d-flex gap-2 flex-wrap">

                            <button type="submit"
                                class="btn btn-success btn-modern">

                                Salvar cidade
                            </button>

                            <a href="{{ route('cidades.index') }}"
                                class="btn btn-outline-secondary btn-modern">

                                Voltar
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
@endsection
