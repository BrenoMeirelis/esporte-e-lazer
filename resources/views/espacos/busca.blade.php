<form method="GET" action="{{ route('espacos.buscar') }}">
    <input type="text" name="nome" placeholder="Buscar espaço">

    <select name="categoria_id">
        <option value="">Todas categorias</option>

        @foreach($categorias as $cat)
            <option value="{{ $cat->id }}">{{ $cat->nome }}</option>
        @endforeach
    </select>

    <button>Buscar</button>
</form>

@foreach($espacos as $espaco)
    <div>
        <h3>{{ $espaco->nome }}</h3>
        <p>Categoria: {{ $espaco->categoria->nome ?? 'Sem categoria' }}</p>
    </div>
@endforeach
