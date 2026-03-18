@extends('layouts.app')

@section('content')

<style>
.hero-form {
    background: linear-gradient(135deg, #198754, #157347);
    color: white;
    padding: 50px 30px;
    border-radius: 15px;
    margin-bottom: 40px;
    text-align: center;
}

.hero-form h1 {
    font-weight: 700;
    font-size: 36px;
}

.form-card {
    background: #f8f9fa;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.section-title {
    font-weight: 600;
    margin-top: 25px;
    margin-bottom: 15px;
    color: #198754;
    border-left: 4px solid #198754;
    padding-left: 10px;
}

.input-group-text {
    background: #198754;
    color: white;
    border: none;
}

.btn-success, .btn-secondary {
    padding: 10px 20px;
    font-weight: 600;
}
</style>

<div class="container mt-4">

    <!-- Hero -->
    <div class="hero-form">
        <h1>✏️ Editar Espaço</h1>
        <p>Atualize as informações do espaço público.</p>
    </div>

    <!-- Erros -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erro!</strong> Verifique os campos abaixo:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">
        <form action="{{ route('espacos.update', $espaco->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Informações Básicas -->
            <div class="section-title">Informações Básicas</div>
            <div class="mb-3">
                <label class="form-label">Título</label>
                <div class="input-group">
                    <span class="input-group-text">🏷</span>
                    <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $espaco->titulo) }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea name="descricao" class="form-control" rows="3">{{ old('descricao', $espaco->descricao) }}</textarea>
            </div>

            <!-- Cidade -->
            <input type="hidden" name="cidade_id" value="{{ $espaco->cidade_id }}">
            <div class="mb-3">
                <label class="form-label">Cidade</label>
                <input type="text" class="form-control" value="{{ $espaco->cidade->nome }}" disabled>
            </div>

            <!-- Horários -->
            <div class="section-title">Horários</div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Abertura</label>
                    <input type="time" name="horario_abertura" class="form-control" value="{{ old('horario_abertura', $espaco->horario_abertura) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Encerramento</label>
                    <input type="time" name="horario_encerramento" class="form-control" value="{{ old('horario_encerramento', $espaco->horario_encerramento) }}">
                </div>
            </div>

            <!-- Regras e informações -->
            <div class="section-title">Regras e Informações</div>
            <div class="mb-3">
                <label class="form-label">Período máximo de reserva</label>
                <input type="number" name="periodo_max_reserva" class="form-control" value="{{ old('periodo_max_reserva', $espaco->periodo_max_reserva) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Localização</label>
                <input type="text" name="localizacao" class="form-control" value="{{ old('localizacao', $espaco->localizacao) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Regras</label>
                <textarea name="regras" class="form-control" rows="2">{{ old('regras', $espaco->regras) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Observações</label>
                <textarea name="observacoes" class="form-control" rows="2">{{ old('observacoes', $espaco->observacoes) }}</textarea>
            </div>

            <!-- Capacidade -->
            <div class="section-title">Capacidade</div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Mínimo de participantes</label>
                    <input type="number" name="min_participantes" class="form-control" value="{{ old('min_participantes', $espaco->min_participantes) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Máximo de participantes</label>
                    <input type="number" name="max_participantes" class="form-control" value="{{ old('max_participantes', $espaco->max_participantes) }}">
                </div>
            </div>

            <!-- Outros -->
            <div class="section-title">Outros</div>
            <div class="mb-3">
                <label class="form-label">Materiais disponíveis</label>
                <textarea name="materiais" class="form-control" rows="2">{{ old('materiais', $espaco->materiais) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Responsável</label>
                <input type="text" name="responsavel" class="form-control" value="{{ old('responsavel', $espaco->responsavel) }}">
            </div>

            <!-- Botões -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('espacos.index', ['cidade_id' => $espaco->cidade_id]) }}" class="btn btn-secondary">← Voltar</a>
                <button type="submit" class="btn btn-success">✔ Atualizar Espaço</button>
            </div>

        </form>
    </div>
</div>

@endsection
