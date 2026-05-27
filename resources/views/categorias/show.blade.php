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
        }

        .page-hero p {
            color: #a0a0c0;
            margin: 0;
        }

        .content-wrapper {
            margin-top: -20px;
            padding-bottom: 50px;
        }

        .content-box {
            background: #fff;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 -4px 24px rgba(0, 0, 0, 0.08);
        }

        .info-card {
            border: 1px solid #ececec;
            border-radius: 18px;
            overflow: hidden;
        }

        .info-header {
            background: #fafaf8;
            padding: 20px 24px;
            border-bottom: 1px solid #eee;
            font-weight: 700;
        }

        .info-body {
            padding: 28px;
        }

        .info-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #999;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 18px;
            font-weight: 600;
            color: #1a1a2e;
        }

        .btn-modern {
            border-radius: 12px;
            padding: 10px 18px;
            font-weight: 600;
        }
    </style>

    <div class="page-hero">
        <div class="container">
            <h1>Categoria 📂</h1>
            <p>Visualize os detalhes da categoria cadastrada.</p>
        </div>
    </div>

    <div class="container content-wrapper">

        <div class="content-box">

            <div class="info-card">

                <div class="info-header">
                    📋 Detalhes da categoria
                </div>

                <div class="info-body">

                    <div class="mb-4">
                        <div class="info-label">
                            ID
                        </div>

                        <div class="info-value">
                            #{{ $categoria->id }}
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="info-label">
                            Nome da categoria
                        </div>

                        <div class="info-value">
                            {{ $categoria->nome }}
                        </div>
                    </div>

                    <div class="d-flex justify-content-between flex-wrap gap-2">

                        <a href="{{ route('categorias.index', $categoria->cidade_id) }}"
                            class="btn btn-outline-secondary btn-modern">
                            ← Voltar
                        </a>

                        <a href="{{ route('categorias.edit', $categoria->id) }}"
                            class="btn btn-warning btn-modern text-white">
                            Editar
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
