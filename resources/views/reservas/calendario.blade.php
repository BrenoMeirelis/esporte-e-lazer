@extends('layouts.app')

@section('content')

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">

<style>
body {
    font-family: 'Roboto', sans-serif;
}

/* HERO MODERNO */
.hero-calendar{
    background: linear-gradient(rgba(0,0,0,0.35), rgba(0,0,0,0.35)), url('https://images.unsplash.com/photo-1508609349937-5ec4ae374ebf') no-repeat center center;
    background-size: cover;
    color:white;
    padding:100px 30px;
    border-radius: 20px;
    text-align: center;
    margin-bottom: 50px;
    text-shadow: 0 2px 15px rgba(0,0,0,0.5);
}

.hero-calendar h1{
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 44px;
    margin-bottom: 15px;
}

.hero-calendar p{
    font-size: 18px;
    line-height: 1.7;
}

/* CALENDÁRIO ESTILIZADO */
#calendar {
    background: #ffffff;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    margin-bottom: 50px;
}

/* BOTÃO VOLTAR */
.btn-calendar {
    display: inline-block;
    margin-bottom: 25px;
    background: #0d6efd;
    color: white;
    font-weight: 600;
    padding: 10px 25px;
    border-radius: 50px;
    text-decoration: none;
    transition: all 0.3s ease;
}
.btn-calendar:hover {
    background: #0b5ed7;
    transform: translateY(-2px);
    text-decoration: none;
}

/* TÍTULO SEÇÃO */
.section-title {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 32px;
    margin-bottom: 40px;
    text-align: center;
    color: #212529;
}
.section-title::after {
    content:'';
    display:block;
    width:120px;
    height:3px;
    background:#0d6efd;
    margin:12px auto 0;
    border-radius:2px;
}
</style>

<div class="container">

    {{-- HERO --}}
    <div class="hero-calendar">
        <h1>Calendário de Reservas</h1>
        <p>Visualize todos os espaços públicos disponíveis e reserve datas diretamente pelo calendário de forma prática e organizada.</p>
    </div>

    <a href="{{ route('home') }}" class="btn btn-calendar"><i class="bi bi-house-door-fill"></i> Voltar</a>

    {{-- TÍTULO --}}
    <h3 class="section-title">Calendário de Reservas</h3>

    {{-- CALENDÁRIO --}}
    <div id="calendar"></div>

</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'pt-br',
        events: '/eventos',
        height: 'auto',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
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

<div id="calendar"></div>

<script>

document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',

        events: '/eventos',

        locale: 'pt-br'

    });

    calendar.render();

});

</script>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">



<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',

        locale: 'pt-br',

        events: '/eventos',

        dateClick: function(info) {

            window.location.href = '/reservas/create?data=' + info.dateStr;

        }

    });

    calendar.render();

});

</script>

@endsection
