@extends('layouts.app')

@section('content')

<style>

.hero{
    background: linear-gradient(135deg,#4e73df,#1cc88a);
    color:white;
    padding:60px;
    border-radius:15px;
    margin-bottom:40px;
}

.card-dashboard{
    border:none;
    border-radius:15px;
    overflow:hidden;
    transition:0.3s;
}

.card-dashboard:hover{
    transform:translateY(-8px);
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

.card-dashboard img{
    height:160px;
    object-fit:cover;
}

.numero{
    font-size:40px;
    font-weight:bold;
}

</style>

<div class="container mt-4">

<div class="hero text-center">
    <h1 class="fw-bold">Sistema Esporte & Lazer</h1>
    <p>Gerenciamento de usuários, cidades e categorias de eventos</p>
</div>

<div class="row g-4">

<!-- USUARIOS -->

<div class="col-md-4">
<div class="card card-dashboard">

<img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61" class="card-img-top">

<div class="card-body text-center">

<h5 class="card-title">Usuários</h5>

<div class="numero text-primary">
{{ $usuarios }}
</div>

<p class="text-muted">
Pessoas cadastradas no sistema
</p>

</div>
</div>
</div>


<!-- CIDADES -->

<div class="col-md-4">
<div class="card card-dashboard">

<img src="https://images.unsplash.com/photo-1477959858617-67f85cf4f1df" class="card-img-top">

<div class="card-body text-center">

<h5 class="card-title">Cidades</h5>

<div class="numero text-success">
{{ $cidades }}
</div>

<p class="text-muted">
Cidades registradas
</p>

</div>
</div>
</div>


<!-- CATEGORIAS -->

<div class="col-md-4">
<div class="card card-dashboard">

<img src="https://images.unsplash.com/photo-1508609349937-5ec4ae374ebf" class="card-img-top">

<div class="card-body text-center">

<h5 class="card-title">Categorias</h5>

<div class="numero text-danger">
{{ $categorias }}
</div>

<p class="text-muted">
Tipos de eventos cadastrados
</p>

</div>
</div>
</div>

</div>

</div>

@endsection
