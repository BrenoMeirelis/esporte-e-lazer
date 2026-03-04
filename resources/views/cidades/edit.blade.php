@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Cidade</h2>

    <form action="{{ route('cidades.update', $cidade->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome"
                    value="{{ $cidade->nome }}"
                    class="form-control">
        </div>

        <div class="mb-3">
            <label>CEP</label>
            <input type="text" name="cep"
                    value="{{ $cidade->cep }}"
                    class="form-control">
        </div>

        <div class="mb-3">
            <label>UF</label>
            <input type="text" name="uf"
                    value="{{ $cidade->uf }}"
                    maxlength="2"
                    class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email"
                    value="{{ $cidade->email }}"
                    class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('cidades.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
