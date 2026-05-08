@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
body{
    font-family:'DM Sans',sans-serif;
    background:#f5f4f0;
}

.page-header{
    background:#1a1a2e;
    color:#fff;
    padding:40px 0 80px;
    position:relative;
}

.page-header::after{
    content:'';
    position:absolute;
    bottom:-1px;
    left:0;
    right:0;
    height:48px;
    background:#f5f4f0;
    border-radius:48px 48px 0 0;
}

.page-header h1{
    font-family:'Sora',sans-serif;
    font-size:34px;
    font-weight:700;
}

.form-card{
    background:#fff;
    border-radius:24px;
    border:1.5px solid #e8e7e0;
    padding:30px;
    box-shadow:0 12px 32px rgba(0,0,0,0.08);
    margin-top:30px;
}

.form-label{
    font-size:13px;
    font-weight:600;
    color:#666;
    margin-bottom:8px;
}

.form-control,
.form-select{
    border-radius:14px;
    border:1.5px solid #e5e5e5;
    padding:13px 16px;
    font-size:14px;
}

.form-control:focus,
.form-select:focus{
    border-color:#4a4aff;
    box-shadow:none;
}

.form-text{
    font-size:12px;
    color:#999;
}

.btn-main{
    background:#1a1a2e;
    color:#fff;
    border:none;
    padding:13px 22px;
    border-radius:14px;
    font-size:14px;
    font-weight:600;
    transition:.2s;
}

.btn-main:hover{
    background:#4a4aff;
}

.btn-soft{
    background:#fff;
    border:1.5px solid #e5e5e5;
    color:#555;
    padding:13px 22px;
    border-radius:14px;
    text-decoration:none;
}

.alert-modern{
    border-radius:16px;
    border:none;
}
</style>

<div class="page-header">
    <div class="container">
        <h1>Criar Novo Usuário</h1>
        <p style="color:#9090c0;">
            Cadastre novos usuários no sistema
        </p>
    </div>
</div>

<div class="container">
    <div class="form-card">

        @if($errors->any())
            <div class="alert alert-danger alert-modern">
                <ul class="mb-0">
                    @foreach($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST" id="form-user">
            @csrf

            <div class="row g-4">

                <div class="col-12">
                    <label class="form-label">Nome</label>
                    <input type="text"
                           name="name"
                           id="name"
                           class="form-control"
                           value="{{ old('name') }}"
                           maxlength="80"
                           minlength="3"
                           required>
                    <div class="form-text">Digite apenas letras. Mínimo 3 caracteres.</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">CPF</label>
                    <input type="text"
                           name="cpf"
                           id="cpf"
                           class="form-control"
                           value="{{ old('cpf') }}"
                           maxlength="14"
                           inputmode="numeric"
                           placeholder="000.000.000-00"
                           required>
                    <div class="form-text">Obrigatório: 11 números.</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Telefone</label>
                    <input type="text"
                           name="telefone"
                           id="telefone"
                           class="form-control"
                           value="{{ old('telefone') }}"
                           maxlength="15"
                           inputmode="numeric"
                           placeholder="(00) 00000-0000"
                           required>
                    <div class="form-text">Obrigatório: 10 ou 11 números.</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nascimento</label>
                    <input type="date"
                           name="data_nascimento"
                           id="data_nascimento"
                           class="form-control"
                           value="{{ old('data_nascimento') }}"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tipo</label>
                    <select name="tipo" class="form-select" required>
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
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           id="email"
                           class="form-control"
                           value="{{ old('email') }}"
                           maxlength="120"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Senha</label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control"
                           minlength="8"
                           maxlength="30"
                           required>
                    <div class="form-text">Mínimo 8 caracteres.</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Confirmar Senha</label>
                    <input type="password"
                           name="password_confirmation"
                           id="password_confirmation"
                           class="form-control"
                           minlength="8"
                           maxlength="30"
                           required>
                </div>

            </div>

            <div class="d-flex justify-content-between mt-5">
                <a href="{{ route('users.index') }}" class="btn-soft">
                    ← Voltar
                </a>

                <button type="submit" class="btn-main">
                    Criar Usuário
                </button>
            </div>

        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-user');
    const nome = document.getElementById('name');
    const cpf = document.getElementById('cpf');
    const telefone = document.getElementById('telefone');
    const nascimento = document.getElementById('data_nascimento');
    const senha = document.getElementById('password');
    const confirmarSenha = document.getElementById('password_confirmation');

    function somenteNumeros(valor) {
        return valor.replace(/\D/g, '');
    }

    function aplicarMascaraCPF(valor) {
        valor = somenteNumeros(valor).slice(0, 11);
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        return valor;
    }

    function aplicarMascaraTelefone(valor) {
        valor = somenteNumeros(valor).slice(0, 11);

        if (valor.length <= 10) {
            valor = valor.replace(/(\d{2})(\d)/, '($1) $2');
            valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
        } else {
            valor = valor.replace(/(\d{2})(\d)/, '($1) $2');
            valor = valor.replace(/(\d{5})(\d)/, '$1-$2');
        }

        return valor;
    }

    cpf.addEventListener('input', function () {
        cpf.value = aplicarMascaraCPF(cpf.value);
    });

    telefone.addEventListener('input', function () {
        telefone.value = aplicarMascaraTelefone(telefone.value);
    });

    nome.addEventListener('input', function () {
        nome.value = nome.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '').slice(0, 80);
    });

    nascimento.addEventListener('change', function () {
        const hoje = new Date();
        const dataInformada = new Date(nascimento.value);

        if (dataInformada > hoje) {
            nascimento.setCustomValidity('A data de nascimento não pode ser futura.');
        } else {
            nascimento.setCustomValidity('');
        }
    });

    confirmarSenha.addEventListener('input', function () {
        if (senha.value !== confirmarSenha.value) {
            confirmarSenha.setCustomValidity('As senhas não conferem.');
        } else {
            confirmarSenha.setCustomValidity('');
        }
    });

    senha.addEventListener('input', function () {
        if (confirmarSenha.value && senha.value !== confirmarSenha.value) {
            confirmarSenha.setCustomValidity('As senhas não conferem.');
        } else {
            confirmarSenha.setCustomValidity('');
        }
    });

    form.addEventListener('submit', function (event) {
        const cpfNumeros = somenteNumeros(cpf.value);
        const telefoneNumeros = somenteNumeros(telefone.value);

        if (cpfNumeros.length !== 11) {
            event.preventDefault();
            cpf.setCustomValidity('O CPF precisa ter exatamente 11 números.');
            cpf.reportValidity();
            return;
        }

        cpf.setCustomValidity('');

        if (telefoneNumeros.length < 10 || telefoneNumeros.length > 11) {
            event.preventDefault();
            telefone.setCustomValidity('O telefone precisa ter 10 ou 11 números.');
            telefone.reportValidity();
            return;
        }

        telefone.setCustomValidity('');

        if (senha.value !== confirmarSenha.value) {
            event.preventDefault();
            confirmarSenha.setCustomValidity('As senhas não conferem.');
            confirmarSenha.reportValidity();
            return;
        }

        confirmarSenha.setCustomValidity('');
    });
});
</script>
@endsection
