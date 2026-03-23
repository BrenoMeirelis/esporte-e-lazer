@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Categorias</h2>

        <div class="d-flex gap-2">

            {{-- Botão voltar --}}
            @isset($cidade)
                @if(Route::has('cidades.show'))
                    <a href="{{ route('cidades.show', $cidade->id) }}" class="btn btn-secondary">
                        ← Voltar
                    </a>
                @endif
            @else
                @if(Route::has('cidades.index'))
                    <a href="{{ route('cidades.index') }}" class="btn btn-secondary">
                        ← Voltar
                    </a>
                @endif
            @endisset

            {{-- Nova categoria --}}
            @if(Route::has('categorias.create'))
                <a href="{{ route('categorias.create') }}" class="btn btn-success">
                    + Nova Categoria
                </a>
            @endif

        </div>
    </div>

    {{-- Mensagem --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabela --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th width="220">Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse($categorias as $categoria)
                <tr>
                    <td class="text-center">{{ $categoria->id }}</td>
                    <td>{{ $categoria->nome }}</td>
                    <td class="text-center">

                        @if(Route::has('categorias.show'))
                        <a href="{{ route('categorias.show', $categoria->id) }}" class="btn btn-info btn-sm">
                            Ver
                        </a>
                        @endif

                        @if(Route::has('categorias.edit'))
                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning btn-sm">
                            Editar
                        </a>
                        @endif

                        @if(Route::has('categorias.destroy'))
                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Tem certeza que deseja excluir?')">
                                Excluir
                            </button>
                        </form>
                        @endif

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">
                        Nenhuma categoria cadastrada.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
