@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="hero-form" style="background: linear-gradient(135deg, #198754, #157347); color:white; padding:50px 30px; border-radius:15px; text-align:center; margin-bottom:40px;">
        <h1>📍 Cadastrar Espaço</h1>
        <p>Preencha as informações abaixo para adicionar um novo espaço público.</p>
    </div>

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

    <div class="form-card" style="background:#f8f9fa; padding:30px; border-radius:12px; box-shadow:0 5px 15px rgba(0,0,0,0.1);">
        <form action="{{ route('espacos.store') }}" method="POST">
            @csrf

            <!-- Informações Básicas -->
            <h5>Informações Básicas</h5>
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea name="descricao" class="form-control" rows="3">{{ old('descricao') }}</textarea>
            </div>

            <!-- Cidade -->
            <input type="hidden" name="cidade_id" value="{{ $cidade->id }}">
            <div class="mb-3">
                <label class="form-label">Cidade</label>
                <input type="text" class="form-control" value="{{ $cidade->nome }}" disabled>
            </div>

            <!-- Categoria -->
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <select name="categoria_id" class="form-control" required>
                    <option value="">Selecione</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Horários -->
            <div class="mb-3">
                <label class="form-label">Abertura</label>
                <input type="time" name="horario_abertura" class="form-control" value="{{ old('horario_abertura') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Encerramento</label>
                <input type="time" name="horario_encerramento" class="form-control" value="{{ old('horario_encerramento') }}">
            </div>

            <!-- Regras e Informações -->
            <div class="mb-3">
                <label class="form-label">Período máximo de reserva (horas)</label>
                <input type="number" name="periodo_max_reserva" class="form-control" value="{{ old('periodo_max_reserva', 0) }}" min="0">
            </div>
            <div class="mb-3">
                <label class="form-label">Localização</label>
                <input type="text" name="localizacao" class="form-control" value="{{ old('localizacao') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Regras</label>
                <textarea name="regras" class="form-control">{{ old('regras') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Observações</label>
                <textarea name="observacoes" class="form-control">{{ old('observacoes') }}</textarea>
            </div>

            <!-- Capacidade -->
            <div class="mb-3">
                <label class="form-label">Mínimo de participantes</label>
                <input type="number" name="min_participantes" class="form-control" value="{{ old('min_participantes', 0) }}" min="0">
            </div>
            <div class="mb-3">
                <label class="form-label">Máximo de participantes</label>
                <input type="number" name="max_participantes" class="form-control" value="{{ old('max_participantes', 0) }}" min="0">
            </div>

            <!-- Outros -->
            <div class="mb-3">
                <label class="form-label">Materiais disponíveis</label>
                <textarea name="materiais" class="form-control">{{ old('materiais') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Responsável</label>
                <input type="text" name="responsavel" class="form-control" value="{{ old('responsavel') }}">
            </div>

            <!-- Botões -->
            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('cidades.show', $cidade->id) }}#areas" class="btn btn-secondary">← Voltar</a>
                <button type="submit" class="btn btn-success">✔ Cadastrar Espaço</button>
            </div>
        </form>
    </div>
</div>
@endsection
