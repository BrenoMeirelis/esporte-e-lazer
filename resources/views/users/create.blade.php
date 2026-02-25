<h1>Criar Usuário</h1>

<form action="{{ route('users.store') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Nome"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="text" name="cpf" placeholder="CPF"><br>
    <input type="password" name="password" placeholder="Senha"><br>

    <button type="submit">Salvar</button>
</form>
