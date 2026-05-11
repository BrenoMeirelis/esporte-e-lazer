@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <h2 class="mb-4">
        📅 Reservas de {{ $cidade->nome }}
    </h2>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">

            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Espaço</th>
                        <th>Usuário</th>
                        <th>Horário</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($reservas as $reserva)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($reserva->data)->format('d/m/Y') }}</td>
                            <td>{{ $reserva->espaco->titulo ?? '-' }}</td>
                            <td>{{ $reserva->user->name ?? '-' }}</td>
                            <td>{{ $reserva->hora_inicio }} às {{ $reserva->hora_fim }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Nenhuma reserva encontrada para esta cidade.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
