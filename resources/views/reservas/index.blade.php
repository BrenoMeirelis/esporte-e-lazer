@extends('layouts.app')

@section('content')

<div class="container">

<h2>Controle de Reservas</h2>

<table class="table table-bordered">

    <thead>
    <tr>
    <th>Espaço</th>
    <th>Usuário</th>
    <th>Data</th>
    <th>Hora início</th>
    <th>Hora fim</th>
    </tr>
    </thead>

    <tbody>

    @foreach($reservas as $reserva)

    <tr>
    <td>{{ $reserva->espaco->titulo }}</td>
    <td>{{ $reserva->user->name }}</td>
    <td>{{ $reserva->data }}</td>
    <td>{{ $reserva->hora_inicio }}</td>
    <td>{{ $reserva->hora_fim }}</td>
    </tr>

    @endforeach

    </tbody>

    </table>

</div>

@endsection
