@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
body {
    font-family: 'DM Sans', sans-serif;
    background: #f5f4f0;
}

.calendar-header {
    background: #1a1a2e;
    color: #fff;
    padding: 40px 0 85px;
    position: relative;
    overflow: hidden;
}

.calendar-header::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 48px;
    background: #f5f4f0;
    border-radius: 48px 48px 0 0;
}

.breadcrumb-nav {
    font-size: 13px;
    color: #7070a0;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.breadcrumb-nav a {
    color: #9090c0;
    text-decoration: none;
}

.breadcrumb-nav a:hover {
    color: #fff;
}

.calendar-header h1 {
    font-family: 'Sora', sans-serif;
    font-size: 34px;
    font-weight: 700;
    margin-bottom: 8px;
    letter-spacing: -0.5px;
}

.calendar-header .meta {
    color: #8080b0;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.calendar-panel {
    margin-top: 28px;
    background: #fff;
    border: 1.5px solid #e8e7e0;
    border-radius: 24px;
    box-shadow: 0 14px 36px rgba(0,0,0,0.08);
    overflow: hidden;
}

.calendar-panel-top {
    padding: 20px 24px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
}

.panel-title {
    font-family: 'Sora', sans-serif;
    font-size: 18px;
    font-weight: 600;
    color: #1a1a2e;
    margin: 0;
}

.panel-subtitle {
    color: #888;
    font-size: 13px;
    margin: 4px 0 0;
}

.calendar-body {
    padding: 24px;
}

.btn-soft {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 11px 18px;
    border-radius: 12px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all .2s;
    border: 1.5px solid #e0dfd8;
    background: #fff;
    color: #555;
}

.btn-soft:hover {
    border-color: #4a4aff;
    color: #4a4aff;
    background: #f0f0ff;
}

.fc {
    font-family: 'DM Sans', sans-serif;
}

.fc .fc-toolbar-title {
    font-family: 'Sora', sans-serif;
    font-size: 22px;
    color: #1a1a2e;
    font-weight: 700;
}

.fc .fc-button-primary {
    background: #1a1a2e;
    border-color: #1a1a2e;
    border-radius: 10px;
    font-size: 13px;
    padding: 8px 12px;
}

.fc .fc-button-primary:hover,
.fc .fc-button-primary:focus {
    background: #4a4aff;
    border-color: #4a4aff;
    box-shadow: none;
}

.fc .fc-button-primary:disabled {
    background: #d6d6df;
    border-color: #d6d6df;
}

.fc-theme-standard td,
.fc-theme-standard th,
.fc-theme-standard .fc-scrollgrid {
    border-color: #eee;
}

.fc .fc-daygrid-day-number {
    color: #1a1a2e;
    text-decoration: none;
    font-weight: 600;
    font-size: 13px;
}

.fc .fc-col-header-cell-cushion {
    color: #666;
    text-decoration: none;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .4px;
}

.fc .fc-day-today {
    background: #f0f0ff !important;
}

.fc-event {
    background: #4a4aff !important;
    border: none !important;
    border-radius: 8px !important;
    padding: 3px 6px !important;
    font-size: 12px;
    cursor: pointer;
}

.modal-content {
    border-radius: 22px;
    border: 1.5px solid #e8e7e0;
}

.modal-header {
    background: #1a1a2e;
    color: #fff;
    border-radius: 20px 20px 0 0;
}

.modal-title {
    font-family: 'Sora', sans-serif;
    font-weight: 600;
}

.modal-body p {
    color: #555;
    margin-bottom: 12px;
}

.modal-body strong {
    color: #1a1a2e;
}

@media(max-width: 640px) {
    .calendar-header h1 {
        font-size: 25px;
    }

    .fc .fc-toolbar {
        flex-direction: column;
        gap: 12px;
    }

    .calendar-body {
        padding: 14px;
    }
}
</style>

<div class="calendar-header">
    <div class="container">
        <div class="breadcrumb-nav">
            <a href="{{ route('home') }}"><i class="bi bi-house"></i> Início</a>
            <i class="bi bi-chevron-right" style="font-size:11px;"></i>
            <span>Calendário</span>
        </div>

        <h1>Calendário de Reservas</h1>

        <div class="meta">
            <span><i class="bi bi-calendar-event"></i> Visualize reservas por dia, semana ou mês</span>
            <span><i class="bi bi-clock"></i> Organização em tempo real</span>
        </div>
    </div>
</div>

<div class="container">

    <div class="calendar-panel">

        <div class="calendar-panel-top">
            <div>
                <h2 class="panel-title">Agenda dos espaços</h2>
                <p class="panel-subtitle">Clique em uma reserva para ver os detalhes ou em uma data para criar uma nova reserva.</p>
            </div>

            <a href="{{ route('home') }}" class="btn-soft">
                <i class="bi bi-arrow-left"></i>
                Voltar
            </a>
        </div>

        <div class="calendar-body">
            <div id="calendar" aria-label="Calendário de reservas"></div>
        </div>

    </div>

</div>

<div class="modal fade" id="eventoModal" tabindex="-1" aria-labelledby="eventoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="eventoLabel">
                    <i class="bi bi-calendar-check"></i>
                    Detalhes da Reserva
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">
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
