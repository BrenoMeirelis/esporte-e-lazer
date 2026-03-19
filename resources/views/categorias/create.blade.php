<div class="container mt-5">

    <div class="card shadow col-md-6 mx-auto border-0">

        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Cadastrar Categoria</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('categorias.store') }}" method="POST">
                @csrf

                <!-- NOME -->
                <div class="mb-3">
                    <label class="form-label">Nome da Categoria</label>
                    <input type="text" name="nome" class="form-control"
                        value="{{ old('nome') }}" placeholder="Ex: Quadra, Salão...">

                    @error('nome')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- CIDADE -->
                <div class="mb-3">
                    <label class="form-label">Cidade</label>

                    <select name="cidade_id" class="form-select">
                        <option value="">Selecione uma cidade</option>

                        @foreach($cidades as $cidade)
                            <option value="{{ $cidade->id }}">
                                {{ $cidade->nome }}
                            </option>
                        @endforeach
                    </select>

                    @error('cidade_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- BOTÕES -->
                <div class="d-flex justify-content-between">

                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
                        Voltar
                    </a>

                    <button type="submit" class="btn btn-success">
                        Salvar Categoria
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>
