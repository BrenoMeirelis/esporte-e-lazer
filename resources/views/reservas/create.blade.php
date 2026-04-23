@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow col-md-6 mx-auto">

        <div class="card-header bg-success text-white">
            <h4>Reservar Espaço</h4>
        </div>

        <div class="card-body">

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <h5>📍 {{ $espaco->titulo }}</h5>

            <form method="POST" action="{{ route('reservas.store') }}">
                @csrf

                <input type="hidden" name="espaco_id" value="{{ $espaco->id }}">

                <div class="mb-3">
                    <label>Data</label>
                    <input type="date" name="data" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Hora início</label>
                    <input type="time" name="hora_inicio" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Hora fim</label>
                    <input type="time" name="hora_fim" class="form-control" required>
                </div>

                <button class="btn btn-success w-100">
                    Confirmar Reserva
                </button>

            </form>

        </div>
    </div>

</div>
@endsection
