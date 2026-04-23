@extends('layouts.app')

@section('content')
    @php use Illuminate\Support\Str; @endphp

    <div class="container mt-4">

        <div class="hero-index"
            style="background: linear-gradient(135deg, #198754, #157347); color:white; padding:40px; border-radius:15px; text-align:center; margin-bottom:40px;">
            <h1>📍 Espaços de {{ $cidade->nome }}</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-4">

            @forelse($espacos as $espaco)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">

                        <img src="https://images.unsplash.com/photo-1508609349937-5ec4ae374ebf" class="card-img-top"
                            style="height:200px; object-fit:cover;">

                        <div class="card-body">
                            <h5>{{ $espaco->titulo }}</h5>
                            <p class="text-muted">📍 {{ $cidade->nome }}</p>
                            <p>{{ Str::limit($espaco->descricao, 100) }}</p>
                            <p>👥 {{ $espaco->min_participantes }} - {{ $espaco->max_participantes }}</p>
                        </div>

                        <div class="card-footer bg-white">
                            <a href="{{ route('reservas.create', $espaco->id) }}" class="btn btn-success w-100">
                                Reservar
                            </a>
                        </div>

                    </div>
                </div>
            @empty
                <div class="text-center text-muted">
                    <h5>Nenhum espaço cadastrado</h5>
                </div>
            @endforelse

        </div>

    </div>
@endsection
