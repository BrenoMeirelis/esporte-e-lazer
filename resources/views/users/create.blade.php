<h1>Cadastrar Usuário</h1>

<form method="POST" action="{{ route('users.store') }}">
@csrf

<input name="nome" placeholder="Nome">
<input name="sobrenome" placeholder="Sobrenome">
<input name="cpf" placeholder="CPF">
<input name="telefone" placeholder="Telefone">
<input type="date" name="data_nascimento">
<input name="email" placeholder="Email">
<input type="password" name="password" placeholder="Senha">

<button type="submit">Salvar</button>

</form>
