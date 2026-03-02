@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card border-0 shadow-lg rounded-4">

                {{-- Header com gradiente moderno --}}
                <div class="card-header text-white rounded-top-4"
                        style="background: linear-gradient(135deg, #0ea5e9, #6366f1);">
                    <h4 class="mb-0 fw-semibold">Criar Novo Usuário</h4>
                </div>

                <div class="card-body p-4">

                    {{-- Sucesso --}}
                    @if(session('success'))
                        <div class="alert alert-success rounded-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Erros --}}
                    @if($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <ul class="mb-0">
                                @foreach($errors->all() as $erro)
                                    <li>{{ $erro }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">

                            <div class="col-12">
                                <label class="form-label fw-semibold">Nome</label>
                                <input type="text" name="name"
                                        class="form-control rounded-3 shadow-sm"
                                        value="{{ old('name') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">CPF</label>
                                <input type="text" name="cpf" id="cpf"
                                        class="form-control rounded-3 shadow-sm"
                                        value="{{ old('cpf') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Telefone</label>
                                <input type="text" name="telefone" id="telefone"
                                        class="form-control rounded-3 shadow-sm"
                                        value="{{ old('telefone') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Data de Nascimento</label>
                                <input type="date" name="data_nascimento"
                                        class="form-control rounded-3 shadow-sm"
                                        value="{{ old('data_nascimento') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tipo de Usuário</label>
                                <select name="tipo"
                                        class="form-select rounded-3 shadow-sm" required>
                                    <option value="">Selecione</option>
                                    <option value="admin" {{ old('tipo') == 'admin' ? 'selected' : '' }}>
                                        👑 Administrador
                                    </option>
                                    <option value="usuario" {{ old('tipo') == 'usuario' ? 'selected' : '' }}>
                                        👤 Usuário
                                    </option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email"
                                        class="form-control rounded-3 shadow-sm"
                                        value="{{ old('email') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Senha</label>
                                <input type="password" name="password"
                                        class="form-control rounded-3 shadow-sm" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Confirmar Senha</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control rounded-3 shadow-sm" required>
                            </div>

                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">

                            <a href="{{ route('users.index') }}"
                                class="btn btn-outline-secondary rounded-pill px-4">
                                ← Voltar
                            </a>

                            <button type="submit"
                                    class="btn text-white rounded-pill px-4 shadow-sm"
                                    style="background: linear-gradient(135deg, #0ea5e9, #6366f1); border: none;">
                                Criar Usuário
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

{{-- Máscaras --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const cpfInput = document.getElementById('cpf');
    cpfInput.addEventListener('input', function () {
        let value = cpfInput.value.replace(/\D/g, '');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        cpfInput.value = value;
    });

    const telInput = document.getElementById('telefone');
    telInput.addEventListener('input', function () {
        let value = telInput.value.replace(/\D/g, '');

        if (value.length <= 10) {
            value = value.replace(/(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d{4})(\d)/, '$1-$2');
        } else {
            value = value.replace(/(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
        }

        telInput.value = value;
    });

});
</script>

@endsection
