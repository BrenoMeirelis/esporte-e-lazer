@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Cidades</h2>

    <a href="{{ route('cidades.create') }}" class="btn btn-primary mb-3">
        Nova Cidade
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CEP</th>
                <th>UF</th>
                <th>Email</th>
                <th width="180px">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cidades as $cidade)
            <tr>
                <td>{{ $cidade->nome }}</td>
                <td>{{ $cidade->cep }}</td>
                <td>{{ $cidade->uf }}</td>
                <td>{{ $cidade->email }}</td>
                <td>
                    <a class="btn btn-info btn-sm"
                        href="{{ route('cidades.show',$cidade->id) }}">
                        Ver
                    </a>

                    <a class="btn btn-warning btn-sm"
                        href="{{ route('cidades.edit',$cidade->id) }}">
                        Editar
                    </a>

                    <form action="{{ route('cidades.destroy',$cidade->id) }}"
                        method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-danger btn-sm">
                            Excluir
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
