@extends('layouts.app')

@section('content')

<style>
.hero-form{
    background-color: #198754; /* verde da prefeitura */
    color:white;
    padding:50px 30px;
    border-radius:15px;
    margin-bottom:40px;
    position: relative;
    text-align: center;
}

.hero-form h1{
    font-weight:700;
    font-size:36px;
}

.form-card{
    background:#f8f9fa;
    padding:30px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    transition:0.3s;
}

.form-card:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

.btn-space{
    margin-right:10px;
}
</style>

<div class="container mt-4">

    <!-- Hero -->
    <div class="hero-form">
        <h1>Editar Espaço</h1>
        <p>Atualize as informações do espaço público de forma rápida e organizada.</p>
    </div>

    <!-- Form Card -->
    <div class="form-card">

        <form action="{{ route('espacos.update', $espaco->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" value="{{ $espaco->titulo }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea name="descricao" class="form-control" rows="3">{{ $espaco->descricao }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Cidade</label>
                <select name="cidade_id" class="form-select">
                    @foreach($cidades as $cidade)
                        <option value="{{ $cidade->id }}" @if($cidade->id == $espaco->cidade_id) selected @endif>
                            {{ $cidade->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Horário de abertura</label>
                    <input type="time" name="horario_abertura" class="form-control" value="{{ $espaco->horario_abertura }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Horário de encerramento</label>
                    <input type="time" name="horario_encerramento" class="form-control" value="{{ $espaco->horario_encerramento }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Localização</label>
                <input type="text" name="localizacao" class="form-control" value="{{ $espaco->localizacao }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Regras</label>
                <textarea name="regras" class="form-control" rows="2">{{ $espaco->regras }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Observações</label>
                <textarea name="observacoes" class="form-control" rows="2">{{ $espaco->observacoes }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Mínimo de participantes</label>
                    <input type="number" name="min_participantes" class="form-control" value="{{ $espaco->min_participantes }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Máximo de participantes</label>
                    <input type="number" name="max_participantes" class="form-control" value="{{ $espaco->max_participantes }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Materiais disponíveis</label>
                <textarea name="materiais" class="form-control" rows="2">{{ $espaco->materiais }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Responsável</label>
                <input type="text" name="responsavel" class="form-control" value="{{ $espaco->responsavel }}">
            </div>

            <button type="submit" class="btn btn-success btn-space">Atualizar Espaço</button>
            <a href="{{ route('espacos.index') }}" class="btn btn-secondary">Voltar</a>

        </form>

    </div>

</div>

@endsection
