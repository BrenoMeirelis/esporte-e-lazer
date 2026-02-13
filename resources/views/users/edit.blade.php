<h1>Editar Usuário</h1>

<form method="POST" action="{{ route('users.update',$user) }}">
@csrf
@method('PUT')

<input name="nome" value="{{ $user->nome }}">
<input name="sobrenome" value="{{ $user->sobrenome }}">
<input name="cpf" value="{{ $user->cpf }}">
<input name="telefone" value="{{ $user->telefone }}">
<input type="date" name="data_nascimento" value="{{ $user->data_nascimento->format('Y-m-d') }}">
<input name="email" value="{{ $user->email }}">

<button type="submit">Atualizar</button>

</form>
