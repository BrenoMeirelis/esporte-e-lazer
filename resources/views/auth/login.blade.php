@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
<div class="col-md-4">

<h3 class="mb-4">Login</h3>

<form method="POST" action="{{ route('login.post') }}">
@csrf

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Senha</label>
<input type="password" name="password" class="form-control" required>
</div>

<button class="btn btn-primary w-100">
Entrar
</button>

</form>

</div>
</div>

@endsection
