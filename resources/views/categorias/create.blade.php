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

        .form-card {
            border: 1px solid #ececec;
            border-radius: 18px;
            overflow: hidden;
        }

        .form-header {
            background: #fafaf8;
            padding: 20px 24px;
            border-bottom: 1px solid #eee;
            font-weight: 700;
        }

        .form-body {
            padding: 28px;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 14px 16px;
            background: #fafaf8;
            border: 1.5px solid #e0dfd8;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #4a4aff;
            box-shadow: 0 0 0 3px rgba(74, 74, 255, 0.1);
        }

        .btn-modern {
            border-radius: 12px;
            padding: 10px 18px;
            font-weight: 600;
        }
    </style>

    <div class="page-hero">
        <div class="container">
            <h1>Nova Categoria 📂</h1>
        </div>
    </div>

    <div class="container content-wrapper">

        <div class="content-box">

            @if (session('success'))
                <div class="alert alert-success rounded-4 border-0 shadow-sm mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="form-card">

                <div class="form-header">
                    ➕ Cadastro de categoria
                </div>

                <div class="form-body">

                    <form action="{{ route('categorias.store') }}" method="POST">

                        @csrf

                        <div class="mb-4">

                            <label class="form-label">
                                Nome da Categoria
                            </label>

                            <input type="text" name="nome" class="form-control" value="{{ old('nome') }}"
                                placeholder="Digite o nome da categoria">

                            @error('nome')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Cidade
                            </label>

                            <select name="cidade_id" class="form-select">

                                <option value="">
                                    -- Selecione uma cidade --
                                </option>

                                @foreach ($cidades as $cidade)
                                    <option value="{{ $cidade->id }}"
                                        {{ old('cidade_id') == $cidade->id ? 'selected' : '' }}>
                                        {{ $cidade->nome }}
                                    </option>
                                @endforeach

                            </select>

                            @error('cidade_id')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="d-flex gap-2 flex-wrap">

                            <button type="submit" class="btn btn-success btn-modern">
                                Cadastrar
                            </button>

                            <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary btn-modern">
                                Voltar
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
@endsection
