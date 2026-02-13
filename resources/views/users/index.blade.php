<h1>Lista de Usuários</h1>

<a href="{{ route('users.create') }}">Novo</a>

@foreach($users as $user)
    <p>
        {{ $user->nome }} {{ $user->sobrenome }}
        <a href="{{ route('users.show',$user) }}">Ver</a>
        <a href="{{ route('users.edit',$user) }}">Editar</a>

        <form method="POST" action="{{ route('users.destroy',$user) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Excluir</button>
        </form>
    </p>
@endforeach
