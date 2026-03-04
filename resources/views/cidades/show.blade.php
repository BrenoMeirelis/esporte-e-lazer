@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalhes da Cidade</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Nome:</strong> {{ $cidade->nome }}</p>
            <p><strong>CEP:</strong> {{ $cidade->cep }}</p>
            <p><strong>UF:</strong> {{ $cidade->uf }}</p>
            <p><strong>Email:</strong> {{ $cidade->email }}</p>
        </div>
    </div>

    <a href="{{ route('cidades.index') }}"
        class="btn btn-secondary mt-3">
        Voltar
    </a>
</div>
@endsection
