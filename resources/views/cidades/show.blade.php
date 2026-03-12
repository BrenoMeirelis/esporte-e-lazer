@extends('layouts.app')

@section('content')

<div class="container">

<div class="card shadow mb-4">

<div class="card-header bg-success text-white">
<h4 class="mb-0">Cidade: {{ $cidade->nome }}</h4>
</div>

<div class="card-body">

<ul class="nav nav-tabs" id="cidadeTabs">

<li class="nav-item">
<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#usuarios">
Usuários Autorizados
</button>
</li>

<li class="nav-item">
<button class="nav-link" data-bs-toggle="tab" data-bs-target="#espacos">
Áreas da Cidade
</button>
</li>

</ul>

<div class="tab-content mt-4">

<!-- ABA USUÁRIOS -->

<div class="tab-pane fade show active" id="usuarios">

<div class="card shadow-sm">

<div class="card-header bg-light">

<form method="GET" action="" class="d-flex gap-2">

<input type="text" name="busca" class="form-control" placeholder="Buscar por nome, email ou CPF">

<button class="btn btn-success">
Pesquisar
</button>

</form>

</div>

<div class="card-body">

<table class="table table-striped table-hover">

<thead class="table-dark">

<tr>
<th>Nome</th>
<th>Email</th>
<th>CPF</th>
</tr>

</thead>

<tbody>

@forelse($usuarios as $user)

<tr>
<td>{{ $user->name }}</td>
<td>{{ $user->email }}</td>
<td>{{ $user->cpf }}</td>
</tr>

@empty

<tr>
<td colspan="3" class="text-center">
Nenhum usuário autorizado
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

<!-- ABA ESPAÇOS -->

<div class="tab-pane fade" id="espacos">

<div class="card shadow-sm">

<div class="card-header bg-light">

<h5 class="mb-0">Áreas cadastradas</h5>

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>
<th>Título</th>
<th width="250">Ações</th>
</tr>

</thead>

<tbody>

@forelse($espacos as $espaco)

<tr>

<td>{{ $espaco->titulo }}</td>

<td>

<a href="{{ route('espacos.show',$espaco->id) }}" class="btn btn-info btn-sm">
Ver
</a>

<a href="{{ route('espacos.edit',$espaco->id) }}" class="btn btn-warning btn-sm">
Editar
</a>

<a href="/calendario?espaco={{ $espaco->id }}" class="btn btn-success btn-sm">
Reservas
</a>

</td>

</tr>

@empty

<tr>
<td colspan="2" class="text-center">
Nenhuma área cadastrada
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

@endsection
