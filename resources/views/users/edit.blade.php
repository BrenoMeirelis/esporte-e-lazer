<h1>Editar Usuário</h1>

<form action="{{ route('users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $user->name }}"><br>
    <input type="email" name="email" value="{{ $user->email }}"><br>
    <input type="text" name="cpf" value="{{ $user->cpf }}"><br>

    <button type="submit">Atualizar</button>
</form>
