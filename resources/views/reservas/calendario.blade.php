@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
/* HERO */
.hero-calendar{
    background: linear-gradient(135deg, #4f46e5, #9333ea);
    color:white;
    padding:60px 30px;
    border-radius: 20px;
    text-align: center;
    margin-bottom: 40px;
}

.hero-calendar h1{
    font-weight: 700;
    font-size: 36px;
}

.hero-calendar p{
    opacity: 0.9;
}

/* CARD CALENDÁRIO */
.calendar-card{
    background: #fff;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

/* BOTÃO */
.btn-voltar{
    border-radius: 50px;
}
</style>

<div class="container py-4">

    {{-- HERO --}}
    <div class="hero-calendar">
        <h1><i class="bi bi-calendar-event"></i> Calendário de Reservas</h1>
        <p>Visualize, organize e reserve espaços de forma simples e rápida.</p>
    </div>

    {{-- BOTÃO --}}
    <div class="mb-3">
        <a href="{{ route('home') }}" class="btn btn-primary btn-voltar">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>

    {{-- CALENDÁRIO --}}
    <div class="calendar-card">
        <div id="calendar" aria-label="Calendário de reservas"></div>
    </div>

</div>

<!-- MODAL (acessível) -->
<div class="modal fade" id="eventoModal" tabindex="-1" aria-labelledby="eventoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-4">

      <div class="modal-header">
        <h5 class="modal-title" id="eventoLabel">Detalhes da Reserva</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <p><strong>Espaço:</strong> <span id="modalEspaco"></span></p>
        <p><strong>Usuário:</strong> <span id="modalUsuario"></span></p>
        <p><strong>Horário:</strong> <span id="modalHorario"></span></p>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    let calendarEl = document.getElementById('calendar');

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'pt-br',
        height: 'auto',

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        buttonText: {
            today: 'Hoje',
            month: 'Mês',
            week: 'Semana',
            day: 'Dia'
        },

        events: '/eventos',

        dateClick: function(info) {
            window.location.href = "/reservas/create?data=" + info.dateStr;
        },

        eventClick: function(info) {
            let evento = info.event.extendedProps;

            document.getElementById('modalEspaco').innerText = evento.espaco || 'Não informado';
            document.getElementById('modalUsuario').innerText = evento.usuario || 'Não informado';
            document.getElementById('modalHorario').innerText =
                (evento.hora_inicio || '--') + " - " + (evento.hora_fim || '--');

            let modal = new bootstrap.Modal(document.getElementById('eventoModal'));
            modal.show();
        }
    });

    calendar.render();
});
</script>

@endsection
