@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow col-md-6 mx-auto border-0">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0">Editar Categoria</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome da Categoria</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $categoria->nome) }}">
                    @error('nome')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Voltar</a>
            </form>
        </div>
    </div>
</div>
@endsection
