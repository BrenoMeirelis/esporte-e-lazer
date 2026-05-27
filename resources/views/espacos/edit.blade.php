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

        .section-title {
            font-family: 'Sora', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 18px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .form-label {
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            border: 1.5px solid #e0dfd8;
            padding: 14px 16px;
            background: #fafaf8;
            transition: all 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #4a4aff;
            box-shadow: 0 0 0 3px rgba(74, 74, 255, 0.1);
            background: #fff;
        }

        textarea.form-control {
            min-height: 110px;
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
            <h1>Editar Espaço ✏️</h1>

            <p>
                Atualize as informações do espaço público.
            </p>
        </div>
    </div>

    <div class="container content-wrapper">

        <div class="content-box">

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <strong>Erro!</strong> Verifique os campos abaixo:

                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-card">

                <div class="form-card-header">
                    🏟 Informações do espaço
                </div>

                <div class="form-card-body">

                    <form action="{{ route('espacos.update', $espaco->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="section-title">
                            Informações básicas
                        </div>

                        <div class="row">

                            <div class="col-md-8 mb-4">
                                <label class="form-label">
                                    Título
                                </label>

                                <input type="text" name="titulo" class="form-control"
                                    placeholder="Digite o nome do espaço" value="{{ old('titulo', $espaco->titulo) }}"
                                    required>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label">
                                    Cidade
                                </label>

                                <input type="hidden" name="cidade_id" value="{{ $espaco->cidade_id }}">

                                <input type="text" class="form-control" value="{{ $espaco->cidade->nome }}" disabled>
                            </div>

                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                Descrição
                            </label>

                            <textarea name="descricao" class="form-control" rows="3" placeholder="Descreva o espaço">{{ old('descricao', $espaco->descricao) }}</textarea>
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-4">
                                <label class="form-label">
                                    Categoria
                                </label>

                                <select name="categoria_id" class="form-select" required>

                                    <option value="">
                                        Selecione uma categoria
                                    </option>

                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}"
                                            {{ old('categoria_id', $espaco->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nome }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">
                                    Localização
                                </label>

                                <input type="text" name="localizacao" class="form-control"
                                    placeholder="Endereço ou ponto de referência"
                                    value="{{ old('localizacao', $espaco->localizacao) }}">
                            </div>

                        </div>

                        <div class="section-title mt-2">
                            Horários e reservas
                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-4">
                                <label class="form-label">
                                    Abertura
                                </label>

                                <input type="time" name="horario_abertura" class="form-control"
                                    value="{{ old('horario_abertura', $espaco->horario_abertura) }}">
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label">
                                    Encerramento
                                </label>

                                <input type="time" name="horario_encerramento" class="form-control"
                                    value="{{ old('horario_encerramento', $espaco->horario_encerramento) }}">
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label">
                                    Período máximo de reserva
                                </label>

                                <input type="number" name="periodo_max_reserva" class="form-control"
                                    value="{{ old('periodo_max_reserva', $espaco->periodo_max_reserva) }}" min="0">

                                <small class="text-muted">
                                    Em horas
                                </small>
                            </div>

                        </div>

                        <div class="section-title mt-2">
                            Capacidade
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-4">
                                <label class="form-label">
                                    Mínimo de participantes
                                </label>

                                <input type="number" name="min_participantes" class="form-control"
                                    value="{{ old('min_participantes', $espaco->min_participantes) }}" min="0">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">
                                    Máximo de participantes
                                </label>

                                <input type="number" name="max_participantes" class="form-control"
                                    value="{{ old('max_participantes', $espaco->max_participantes) }}" min="0">
                            </div>

                        </div>

                        <div class="section-title mt-2">
                            Regras e informações adicionais
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                Regras
                            </label>

                            <textarea name="regras" class="form-control" placeholder="Informe as regras de uso do espaço">{{ old('regras', $espaco->regras) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                Observações
                            </label>

                            <textarea name="observacoes" class="form-control" placeholder="Adicione observações importantes">{{ old('observacoes', $espaco->observacoes) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                Materiais disponíveis
                            </label>

                            <textarea name="materiais" class="form-control" placeholder="Informe os materiais disponíveis no espaço">{{ old('materiais', $espaco->materiais) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                Responsável
                            </label>

                            <input type="text" name="responsavel" class="form-control"
                                placeholder="Nome do responsável" value="{{ old('responsavel', $espaco->responsavel) }}">
                        </div>

                        <div class="d-flex justify-content-between flex-wrap gap-2 mt-4">

                            <a href="{{ route('espacos.index', ['cidade' => $espaco->cidade_id]) }}"
                                class="btn btn-outline-secondary btn-modern">
                                ← Voltar
                            </a>

                            <button type="submit" class="btn btn-success btn-modern">
                                ✔ Atualizar Espaço
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
@endsection
