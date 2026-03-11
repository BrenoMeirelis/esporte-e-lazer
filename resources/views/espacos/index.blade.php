@extends('layouts.app')

@section('content')

<style>
.hero-index{
    background-color: #198754;
    color:white;
    padding:40px 20px;
    border-radius:15px;
    text-align:center;
    margin-bottom:40px;
}

.hero-index h1{
    font-size:36px;
    font-weight:700;
}

.hero-index p{
    font-size:18px;
}

.card-espaco{
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    transition:0.3s;
}

.card-espaco:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

.card-footer a, .card-footer form{
    display:inline-block;
    margin-right:5px;
}

.card-img-top{
    height:200px;
    object-fit:cover;
}
</style>

<div class="container mt-4">

    <!-- Hero -->
    <div class="hero-index">
        <h1>Espaços Públicos</h1>
        <p>Visualize, edite e gerencie os espaços disponíveis para reserva.</p>
        <a href="{{ route('espacos.create') }}" class="btn btn-success btn-lg mt-3">Cadastrar Novo Espaço</a>
    </div>

    <!-- Espaços -->
    <div class="row g-4">
        @foreach($espacos as $espaco)
            <div class="col-md-4">
                <div class="card card-espaco h-100">

                    <img src="https://images.unsplash.com/photo-1508609349937-5ec4ae374ebf" class="card-img-top">

                    <div class="card-body">
                        <h5 class="card-title">{{ $espaco->titulo }}</h5>
                        <p class="text-muted">📍 {{ $espaco->cidade->nome ?? 'Cidade não definida' }}</p>
                        <p class="card-text">{{ Str::limit($espaco->descricao, 100) }}</p>
                        <p>👥 Capacidade: {{ $espaco->min_participantes }} - {{ $espaco->max_participantes }} pessoas</p>
                    </div>

                    <div class="card-footer bg-white">
                        <a href="#" class="btn btn-primary btn-sm">Reservar</a>
                        <a href="{{ route('espacos.edit',$espaco->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('espacos.destroy',$espaco->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

</div>

@endsection
