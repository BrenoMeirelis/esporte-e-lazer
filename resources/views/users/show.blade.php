<h1>{{ $user->nome }} {{ $user->sobrenome }}</h1>

<p>CPF: {{ $user->cpf }}</p>
<p>Telefone: {{ $user->telefone }}</p>
<p>Nascimento: {{ $user->data_nascimento }}</p>
<p>Email: {{ $user->email }}</p>

@php
    $podeEditar = auth()->user()->role === 'super_admin' || auth()->id() === $user->id;
@endphp

@if ($podeEditar)
    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning mt-3">
        ✏ Editar Perfil
    </a>

    <form action="{{ route('users.destroy', $user) }}" method="POST" class="mt-2"
        onsubmit="return confirm('Tem certeza que deseja excluir seu perfil?')">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">
            🗑 Excluir Perfil
        </button>
    </form>
@endif
