@extends('layouts.app')

@section('content')

<div class="container">

<h2>Nova Reserva</h2>

<form action="{{ route('reservas.store') }}" method="POST">

@csrf

<div class="mb-3">
<label>Espaço</label>

<select name="espaco_id" class="form-control">

@foreach($espacos as $espaco)

<option value="{{ $espaco->id }}">
{{ $espaco->titulo }}
</option>

@if(session('erro'))
<div class="alert alert-danger">
    {{ session('erro') }}
</div>
@endif

@if(session('sucesso'))
<div class="alert alert-success">
    {{ session('sucesso') }}
</div>
@endif

@endforeach

</select>

</div>


<div class="mb-3">
<label>Data</label>

<input type="date"
name="data"
class="form-control"
value="{{ $data }}">
</div>


<div class="mb-3">
<label>Hora início</label>

<input type="time"
name="hora_inicio"
class="form-control">
</div>


<div class="mb-3">
<label>Hora fim</label>

<input type="time"
name="hora_fim"
class="form-control">
</div>


<button class="btn btn-success">
Salvar reserva
</button>

</form>

</div>

@endsection
