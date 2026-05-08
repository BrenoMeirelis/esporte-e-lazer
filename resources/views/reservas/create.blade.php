@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

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
    overflow:hidden;
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
    margin-bottom:8px;
}

.page-header p{
    color:#9090c0;
    margin:0;
}

.reserve-card{
    background:#fff;
    border-radius:24px;
    border:1.5px solid #e8e7e0;
    padding:30px;
    box-shadow:0 14px 36px rgba(0,0,0,0.08);
    margin-top:30px;
}

.space-box{
    background:#f7f7fb;
    border:1.5px solid #ececff;
    border-radius:18px;
    padding:20px;
    margin-bottom:28px;
}

.space-box h3{
    font-family:'Sora',sans-serif;
    font-size:22px;
    color:#1a1a2e;
    margin-bottom:8px;
}

.space-box p{
    color:#777;
    margin:0;
}

.form-label{
    font-size:13px;
    font-weight:600;
    color:#666;
    margin-bottom:8px;
}

.form-control{
    border-radius:14px;
    border:1.5px solid #e5e5e5;
    padding:13px 16px;
    font-size:14px;
    transition:.2s;
}

.form-control:focus{
    border-color:#4a4aff;
    box-shadow:none;
}

.btn-main{
    background:#1a1a2e;
    color:#fff;
    border:none;
    padding:14px 20px;
    border-radius:14px;
    font-size:14px;
    font-weight:600;
    transition:.2s;
    width:100%;
}

.btn-main:hover{
    background:#4a4aff;
}

.btn-soft{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:12px 20px;
    border-radius:14px;
    border:1.5px solid #e5e5e5;
    background:#fff;
    color:#555;
    text-decoration:none;
    transition:.2s;
}

.btn-soft:hover{
    border-color:#4a4aff;
    color:#4a4aff;
    background:#f0f0ff;
}

.alert-modern{
    border:none;
    border-radius:16px;
}

.input-icon{
    position:relative;
}

.input-icon i{
    position:absolute;
    left:14px;
    top:50%;
    transform:translateY(-50%);
    color:#999;
}

.input-icon .form-control{
    padding-left:42px;
}

</style>

<div class="page-header">
    <div class="container">

        <h1>Reservar Espaço</h1>

        <p>
            Escolha a data e horário da reserva
        </p>

    </div>
</div>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="reserve-card">

                @if(session('error'))
                    <div class="alert alert-danger alert-modern">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="space-box">

                    <h3>
                        📍 {{ $espaco->titulo }}
                    </h3>

                    <p>
                        Faça sua reserva de forma rápida e organizada.
                    </p>

                </div>

                <form method="POST" action="{{ route('reservas.store') }}">
                    @csrf

                    <input type="hidden"
                        name="espaco_id"
                        value="{{ $espaco->id }}">

                    <div class="mb-4">

                        <label class="form-label">
                            Data da Reserva
                        </label>

                        <div class="input-icon">
                            <i class="bi bi-calendar-event"></i>

                            <input type="date"
                                name="data"
                                class="form-control"
                                required>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                Hora Início
                            </label>

                            <div class="input-icon">
                                <i class="bi bi-clock"></i>

                                <input type="time"
                                    name="hora_inicio"
                                    class="form-control"
                                    required>
                            </div>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                Hora Fim
                            </label>

                            <div class="input-icon">
                                <i class="bi bi-clock-history"></i>

                                <input type="time"
                                    name="hora_fim"
                                    class="form-control"
                                    required>
                            </div>

                        </div>

                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">

                        <a href="{{ url()->previous() }}"
                            class="btn-soft">

                            <i class="bi bi-arrow-left"></i>
                            Voltar

                        </a>

                        <button type="submit"
                            class="btn-main">

                            Confirmar Reserva

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<script>

document.addEventListener('DOMContentLoaded', function(){

    const horaInicio = document.querySelector('input[name="hora_inicio"]');
    const horaFim = document.querySelector('input[name="hora_fim"]');

    function validarHorario(){

        if(horaInicio.value && horaFim.value){

            if(horaFim.value <= horaInicio.value){

                horaFim.setCustomValidity(
                    'A hora final deve ser maior que a hora inicial.'
                );

            } else {

                horaFim.setCustomValidity('');

            }

        }

    }

    horaInicio.addEventListener('change', validarHorario);
    horaFim.addEventListener('change', validarHorario);

});

</script>

@endsection
