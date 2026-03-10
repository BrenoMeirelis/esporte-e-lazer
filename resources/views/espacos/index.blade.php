@extends('layouts.app')

@section('content')

<h1>Espaços da Prefeitura</h1>

<a href="{{ route('espacos.create') }}">Novo Espaço</a>

<table border="1">

<tr>
<th>Titulo</th>
<th>Cidade</th>
<th>Responsável</th>
<th>Ações</th>
</tr>

@foreach($espacos as $espaco)

<tr>

<td>{{ $espaco->titulo }}</td>
<td>{{ $espaco->cidade->nome }}</td>
<td>{{ $espaco->responsavel }}</td>

<td>

<a href="{{ route('espacos.edit', $espaco->id) }}">Editar</a>

<form action="{{ route('espacos.destroy',$espaco->id) }}" method="POST">
@csrf
@method('DELETE')

<button type="submit">Excluir</button>

</form>

</td>

</tr>

@endforeach

</table>

@endsection
