@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow col-md-6 mx-auto border-0">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Detalhes da Categoria</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>ID:</strong>
                <p>{{ $categoria->id }}</p>
            </div>
            <div class="mb-3">
                <strong>Nome da Categoria:</strong>
                <p>{{ $categoria->nome }}</p>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('categorias.index', $categoria->cidade_id) }}" class="btn btn-secondary">Voltar</a>
                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning">Editar</a>
            </div>
        </div>
    </div>
</div>
@endsection
