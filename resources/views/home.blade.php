@extends('layouts.app')

@section('content')

<style>

.hero{
    background-image: url('https://images.unsplash.com/photo-1477959858617-67f85cf4f1df');
    background-size: cover;
    background-position: center;
    color:white;
    padding:120px 40px;
    border-radius:15px;
    position:relative;
    margin-bottom:50px;
}

.hero::after{
    content:'';
    position:absolute;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background:rgba(0,0,0,0.5);
    border-radius:15px;
}

.hero-content{
    position:relative;
    z-index:2;
}

.hero h1{
    font-weight:700;
    font-size:40px;
}

.hero p{
    font-size:18px;
}

.servico{
    background:#f8f9fa;
    padding:25px;
    border-radius:12px;
    transition:0.3s;
    text-align:center;
}

.servico:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 20px rgba(0,0,0,0.15);
}

.card-dashboard{
    border:none;
    border-radius:15px;
    overflow:hidden;
    transition:0.3s;
}

.card-dashboard:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 30px rgba(0,0,0,0.2);
}

.numero{
    font-size:40px;
    font-weight:bold;
}

.section-title{
    font-weight:700;
    margin-bottom:30px;
    text-align:center;
}

</style>

<a href="/calendario" class="btn btn-success">
    Ver calendário de reservas
    </a>

<div class="container mt-4">

<!-- HERO -->

<div class="hero text-center">

<div class="hero-content">

<h1>Prefeitura Municipal</h1>

<p>
    Sistema digital de reservas de espaços públicos.
    Campos de futebol, quadras esportivas, salões e áreas de lazer disponíveis para a população.
</p>

@guest
<a href="{{ route('login') }}" class="btn btn-success btn-lg mt-3">
    Acessar Sistema
    </a>
@endguest

</div>

</div>


<!-- SERVIÇOS -->

<h3 class="section-title">
    Serviços Disponíveis
</h3>

<div class="row g-4 mb-5">

    <div class="col-md-3">
<div class="servico">

<h5>Campos de Futebol</h5>

<p class="text-muted">
    Reserve campos municipais para jogos e campeonatos.
</p>

</div>
</div>


<div class="col-md-3">
<div class="servico">

<h5>Quadras Esportivas</h5>

<p class="text-muted">
Espaços para futsal, vôlei e atividades esportivas.
</p>

</div>
</div>


<div class="col-md-3">
<div class="servico">

<h5>Salões de Evento</h5>

<p class="text-muted">
Salões comunitários para eventos da população.
</p>

</div>
</div>


<div class="col-md-3">
    <div class="servico">

        <h5>Áreas de Lazer</h5>

<p class="text-muted">
Espaços públicos para recreação e convivência.
</p>

</div>
</div>

</div>


@auth

<!-- DASHBOARD ADMIN -->

<h3 class="section-title">
Painel Administrativo
</h3>

<div class="row g-4">

<div class="col-md-4">

<div class="card card-dashboard text-center p-4">

    <h5>Usuários</h5>

<div class="numero text-primary">
    {{ $usuarios }}
</div>

<p class="text-muted">
Usuários cadastrados
</p>

<a href="/users" class="btn btn-primary btn-sm">
Gerenciar
</a>

</div>

</div>



<div class="col-md-4">

    <div class="card card-dashboard text-center p-4">

<h5>Cidades</h5>

<div class="numero text-success">
{{ $cidades }}
</div>

<p class="text-muted">
    Cidades registradas
</p>

<a href="/cidades" class="btn btn-success btn-sm">
    Gerenciar
</a>


</div>

</div>



<div class="col-md-4">

<div class="card card-dashboard text-center p-4">

<h5>Categorias</h5>

<div class="numero text-danger">
{{ $categorias }}
</div>

<p class="text-muted">
Categorias cadastradas
</p>

<a href="/categorias" class="btn btn-danger btn-sm">
Gerenciar
</a>

</div>

</div>

</div>

@endauth


<!-- SOBRE -->

<div class="mt-5 text-center">

<h3 class="section-title">
Sobre o Sistema
</h3>

<p class="text-muted" style="max-width:700px;margin:auto">

Este sistema foi desenvolvido para facilitar o acesso da população aos espaços públicos da cidade.
Através da plataforma é possível visualizar locais disponíveis e realizar reservas de forma rápida
e organizada, promovendo melhor utilização dos recursos da prefeitura.

</p>

</div>

</div>

@endsection
