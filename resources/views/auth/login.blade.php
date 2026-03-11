@extends('layouts.app')

@section('content')

<style>
.hero-form{
    background-color: #198754;
    color:white;
    padding:50px 30px;
    border-radius:15px;
    margin-bottom:40px;
    position: relative;
    text-align: center;
}

.hero-form h1{
    font-weight:700;
    font-size:36px;
}

.form-card{
    background:#f8f9fa;
    padding:30px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    transition:0.3s;
}

.form-card:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

.btn-space{
    margin-right:10px;
}
</style>

<div class="container mt-4">

    <div class="hero-form">
        <h1>Login</h1>
        <p>Faça login para acessar o sistema de reservas.</p>
    </div>

    <div class="form-card">

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" placeholder="Digite seu e-mail" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" name="password" class="form-control" placeholder="Digite sua senha" required>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <button type="submit" class="btn btn-success btn-space">Entrar</button>
            <a href="{{ route('home') }}" class="btn btn-secondary">Voltar</a>

        </form>

    </div>

</div>

@endsection
