@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow col-md-6 mx-auto border-0">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Cadastrar Categoria</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('categorias.store') }}" method="POST">
                @csrf

                {{-- Nome da categoria --}}
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome da Categoria</label>
                    <input type="text" name="nome" id="nome" class="form-control"
                        value="{{ old('nome') }}" placeholder="Digite o nome da categoria">
                    @error('nome')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Seleção da cidade --}}
                <div class="mb-3">
                    <label for="cidade_id" class="form-label">Cidade</label>
                    <select name="cidade_id" id="cidade_id" class="form-select">
                        <option value="">-- Selecione uma cidade --</option>
                        @foreach($cidades as $cidade)
                            <option value="{{ $cidade->id }}"
                                {{ old('cidade_id') == $cidade->id ? 'selected' : '' }}>
                                {{ $cidade->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('cidade_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Cadastrar</button>
                <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Voltar</a>
            </form>
        </div>
    </div>
</div>
@endsection
