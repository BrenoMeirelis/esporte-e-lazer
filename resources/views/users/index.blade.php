<h1>Lista de Usuários</h1>

<a href="{{ route('users.create') }}">Novo Usuário</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1">
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>CPF</th>
        <th>Ações</th>
    </tr>

    @foreach($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->cpf }}</td>
        <td>
            <a href="{{ route('users.edit', $user) }}">Editar</a>

            <form action="{{ route('users.destroy', $user) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Excluir</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
