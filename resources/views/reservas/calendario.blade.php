@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">

<div class="container">

<h2>Calendário de Reservas</h2>

<div id="calendar"></div>

</div>


<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>

    document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {

    initialView: 'dayGridMonth',

    locale: 'pt-br',

    events: '/eventos',

    dateClick: function(info) {

    window.location.href = "/reservas/create?data=" + info.dateStr;

    },

    eventClick: function(info) {

    let evento = info.event.extendedProps;

    alert(
    "Espaço: " + evento.espaco +
    "\nUsuário: " + evento.usuario +
    "\nHorário: " + evento.hora_inicio + " - " + evento.hora_fim
    );

    }

    });

    calendar.render();

    });

    </script>
@endsection
