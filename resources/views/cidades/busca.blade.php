<form method="GET" action="{{ route('cidades.buscar') }}">
    <input type="text" name="q" placeholder="Buscar cidade">
    <button>Buscar</button>
</form>

@foreach($cidades as $cidade)
    <h2>{{ $cidade->nome }}</h2>

    @foreach($cidade->espacos as $espaco)
        <p>{{ $espaco->nome }}</p>
    @endforeach
@endforeach
