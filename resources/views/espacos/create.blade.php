@extends('layouts.app')

@section('content')

<h1>Cadastrar Espaço</h1>

<form action="{{ route('espacos.store') }}" method="POST">

@csrf

<input type="text" name="titulo" placeholder="Titulo">

<textarea name="descricao" placeholder="Descrição"></textarea>

<select name="cidade_id">

@foreach($cidades as $cidade)

<option value="{{ $cidade->id }}">
{{ $cidade->nome }}
</option>

@endforeach

</select>

<input type="time" name="horario_abertura">

<input type="time" name="horario_encerramento">

<input type="number" name="periodo_max_reserva" placeholder="Periodo max reserva">

<input type="text" name="localizacao" placeholder="Localização">

<textarea name="regras" placeholder="Regras"></textarea>

<textarea name="observacoes" placeholder="Observações"></textarea>

<input type="number" name="min_participantes">

<input type="number" name="max_participantes">

<textarea name="materiais" placeholder="Materiais disponíveis"></textarea>

<input type="text" name="responsavel" placeholder="Responsável">

<button type="submit">Salvar</button>

</form>

@endsection
