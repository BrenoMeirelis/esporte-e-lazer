@extends('layouts.app')

@section('content')
@php use Illuminate\Support\Str; @endphp

<div class="container mt-4">

    <!-- HERO -->
    <div class="hero-index" style="background: linear-gradient(135deg, #198754, #157347); color:white; padding:40px; border-radius:15px; text-align:center; margin-bottom:40px;">
        <h1>📍 Espaços de {{ $cidade->nome }}</h1>
        <p>Visualize, edite e gerencie os espaços disponíveis.</p>
        <div class="mt-3">
            <a href="{{ route('cidades.show', $cidade->id) }}" class="btn btn-outline-light btn-sm">
                ← Voltar para cidade
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        @forelse($espacos as $espaco)
            <div class="col-md-4">
                <div class="card card-espaco h-100" style="border-radius:12px; overflow:hidden; box-shadow:0 5px 15px rgba(0,0,0,0.1);">
                    <img src="https://images.unsplash.com/photo-1508609349937-5ec4ae374ebf" class="card-img-top" style="height:200px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $espaco->titulo }}</h5>
                        <p class="text-muted">📍 {{ $cidade->nome }}</p>
                        <p class="card-text">{{ Str::limit($espaco->descricao, 100) }}</p>
                        <p>👥 {{ $espaco->min_participantes }} - {{ $espaco->max_participantes }} pessoas</p>
                    </div>
                    <div class="card-footer bg-white">
                        <a href="#" class="btn btn-primary btn-sm">Reservar</a>

                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted">
                <h5>Nenhum espaço cadastrado ainda 😕</h5>
                <p>Clique em "Cadastrar Novo Espaço" para começar</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
