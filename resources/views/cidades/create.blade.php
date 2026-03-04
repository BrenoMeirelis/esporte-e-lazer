@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cadastrar Cidade</h2>

    <form action="{{ route('cidades.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control">
        </div>

        <div class="mb-3">
            <label>CEP</label>
            <input type="text" name="cep" class="form-control">
        </div>

        <div class="mb-3">
            <label>UF</label>
            <input type="text" name="uf" maxlength="2" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('cidades.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
