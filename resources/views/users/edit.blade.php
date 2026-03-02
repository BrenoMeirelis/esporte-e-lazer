@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card border-0 shadow-lg rounded-4">

                {{-- Header moderno com gradiente --}}
                <div class="card-header text-white rounded-top-4"
                     style="background: linear-gradient(135deg, #4f46e5, #9333ea);">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 fw-semibold">Editar Usuário</h4>
                        <span class="badge bg-light text-dark px-3 py-2">
                            ID: {{ $user->id }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-4">

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

                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">

                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Nome</label>
                                <input type="text" name="name"
                                       class="form-control rounded-3 shadow-sm"
                                       value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email"
                                       class="form-control rounded-3 shadow-sm"
                                       value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">CPF</label>
                                <input type="text" name="cpf" id="cpf"
                                       class="form-control rounded-3 shadow-sm"
                                       value="{{ old('cpf', $user->cpf) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Telefone</label>
                                <input type="text" name="telefone" id="telefone"
                                       class="form-control rounded-3 shadow-sm"
                                       value="{{ old('telefone', $user->telefone) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Data de Nascimento</label>
                                <input type="date" name="data_nascimento"
                                       class="form-control rounded-3 shadow-sm"
                                       value="{{ old('data_nascimento', optional($user->data_nascimento)->format('Y-m-d')) }}"
                                       required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Tipo</label>
                                <select name="tipo" class="form-select rounded-3 shadow-sm" required>
                                    <option value="admin" {{ old('tipo', $user->tipo) == 'admin' ? 'selected' : '' }}>
                                        👑 Administrador
                                    </option>
                                    <option value="usuario" {{ old('tipo', $user->tipo) == 'usuario' ? 'selected' : '' }}>
                                        👤 Usuário
                                    </option>
                                </select>
                            </div>

                        </div>

                        <hr class="my-4">

                        <h6 class="fw-semibold text-muted mb-3">Alterar Senha</h6>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nova Senha</label>
                                <input type="password" name="password"
                                       class="form-control rounded-3 shadow-sm">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Confirmar Senha</label>
                                <input type="password" name="password_confirmation"
                                       class="form-control rounded-3 shadow-sm">
                            </div>

                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">

                            <a href="{{ route('users.index') }}"
                               class="btn btn-outline-secondary rounded-pill px-4">
                                ← Voltar
                            </a>

                            <button type="submit"
                                    class="btn text-white rounded-pill px-4 shadow-sm"
                                    style="background: linear-gradient(135deg, #4f46e5, #9333ea); border: none;">
                                Atualizar Usuário
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
