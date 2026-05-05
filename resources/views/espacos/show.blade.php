@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    body { font-family: 'DM Sans', sans-serif; background: #f5f4f0; }

    /* HERO */
    .espaco-hero {
        background: #1a1a2e;
        color: #fff;
        padding: 36px 0 72px;
        position: relative;
        overflow: hidden;
    }
    .espaco-hero::before {
        content: '{{ $espaco->titulo[0] ?? "E" }}';
        position: absolute;
        right: -20px;
        top: -30px;
        font-family: 'Sora', sans-serif;
        font-size: 220px;
        font-weight: 700;
        opacity: 0.04;
        color: #fff;
        pointer-events: none;
        letter-spacing: -10px;
    }
    .espaco-hero::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0; right: 0;
        height: 48px;
        background: #f5f4f0;
        border-radius: 48px 48px 0 0;
    }
    .breadcrumb-nav {
        font-size: 13px;
        color: #7070a0;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .breadcrumb-nav a { color: #9090c0; text-decoration: none; }
    .breadcrumb-nav a:hover { color: #fff; }
    .espaco-hero h1 {
        font-family: 'Sora', sans-serif;
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 14px;
        letter-spacing: -0.5px;
        max-width: 600px;
    }
    .espaco-hero .tags {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .tag {
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        border: 1px solid rgba(255,255,255,0.15);
        color: #c0c0e0;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* LAYOUT 2 COLUNAS */
    .espaco-layout {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 28px;
        padding-top: 24px;
        padding-bottom: 60px;
        align-items: start;
    }

    /* COLUNA ESQUERDA */
    .card-section {
        background: #fff;
        border-radius: 18px;
        border: 1.5px solid #e8e7e0;
        padding: 28px;
        margin-bottom: 20px;
    }
    .card-section h3 {
        font-family: 'Sora', sans-serif;
        font-size: 16px;
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .card-section h3 i { color: #4a4aff; }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }
    .info-item {
        background: #fafaf8;
        border-radius: 12px;
        padding: 14px 16px;
        border: 1px solid #f0efe8;
    }
    .info-item .label {
        font-size: 11px;
        color: #aaa;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 5px;
    }
    .info-item .value {
        font-size: 15px;
        font-weight: 500;
        color: #1a1a2e;
    }

    .regras-text {
        font-size: 14px;
        color: #555;
        line-height: 1.7;
        background: #fafaf8;
        border-radius: 10px;
        padding: 16px;
        border: 1px solid #f0efe8;
    }

    /* CALENDÁRIO */
    .calendar-wrap {
        background: #fff;
        border-radius: 18px;
        border: 1.5px solid #e8e7e0;
        padding: 24px;
        margin-bottom: 20px;
        position: sticky;
        top: 20px;
    }
    .calendar-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    .calendar-header h3 {
        font-family: 'Sora', sans-serif;
        font-size: 16px;
        font-weight: 600;
        color: #1a1a2e;
        margin: 0;
    }
    .cal-nav {
        display: flex;
        gap: 6px;
    }
    .cal-nav button {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: 1.5px solid #e0dfd8;
        background: #fafaf8;
        color: #555;
        cursor: pointer;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.15s;
    }
    .cal-nav button:hover { border-color: #4a4aff; color: #4a4aff; background: #f0f0ff; }

    .cal-month {
        font-size: 14px;
        font-weight: 500;
        color: #1a1a2e;
    }

    .cal-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 4px;
    }
    .cal-dow {
        text-align: center;
        font-size: 10px;
        font-weight: 600;
        color: #aaa;
        letter-spacing: 0.5px;
        padding: 6px 0 10px;
        text-transform: uppercase;
    }
    .cal-day {
        text-align: center;
        padding: 7px 4px;
        border-radius: 8px;
        font-size: 13px;
        cursor: pointer;
        color: #333;
        transition: all 0.15s;
        position: relative;
    }
    .cal-day:hover:not(.disabled):not(.past) {
        background: #f0f0ff;
        color: #4a4aff;
    }
    .cal-day.today {
        font-weight: 700;
        color: #4a4aff;
    }
    .cal-day.today::after {
        content: '';
        display: block;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: #4a4aff;
        margin: 2px auto 0;
    }
    .cal-day.reservado {
        background: #fee2e2;
        color: #ef4444;
        cursor: not-allowed;
    }
    .cal-day.reservado::after {
        content: '';
        display: block;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: #ef4444;
        margin: 2px auto 0;
    }
    .cal-day.parcial {
        background: #fef3c7;
        color: #d97706;
    }
    .cal-day.parcial::after {
        content: '';
        display: block;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: #d97706;
        margin: 2px auto 0;
    }
    .cal-day.selected {
        background: #4a4aff;
        color: #fff !important;
        font-weight: 600;
    }
    .cal-day.selected::after { background: #fff; }
    .cal-day.disabled, .cal-day.past {
        color: #ddd;
        cursor: default;
    }
    .cal-day.empty { cursor: default; }

    /* LEGENDA */
    .cal-legend {
        display: flex;
        gap: 12px;
        margin-top: 16px;
        flex-wrap: wrap;
    }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: #777;
    }
    .legend-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }

    /* BOTÃO RESERVAR */
    .btn-reservar {
        display: block;
        width: 100%;
        padding: 15px;
        background: #1a1a2e;
        color: #fff;
        border: none;
        border-radius: 12px;
        font-family: 'Sora', sans-serif;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        text-align: center;
        margin-top: 4px;
    }
    .btn-reservar:hover { background: #4a4aff; color: #fff; transform: translateY(-1px); }
    .btn-reservar:disabled {
        background: #e0dfd8;
        color: #aaa;
        cursor: not-allowed;
        transform: none;
    }

    .day-selected-info {
        background: #f0f0ff;
        border: 1.5px solid #d0d0ff;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 13px;
        color: #4a4aff;
        margin: 14px 0;
        display: none;
    }
    .day-selected-info.show { display: block; }

    @media(max-width: 900px) {
        .espaco-layout { grid-template-columns: 1fr; }
        .calendar-wrap { position: static; }
    }
    @media(max-width: 640px) {
        .espaco-hero h1 { font-size: 22px; }
        .info-grid { grid-template-columns: 1fr; }
        .card-section { padding: 20px; }
    }
</style>

<!-- HERO -->
<div class="espaco-hero">
    <div class="container">
        <div class="breadcrumb-nav">
            <a href="{{ route('cidades.index') }}">Cidades</a>
            <i class="bi bi-chevron-right" style="font-size:11px;"></i>
            <a href="{{ route('espacos.index', $espaco->cidade_id) }}">{{ $espaco->cidade->nome ?? 'Cidade' }}</a>
            <i class="bi bi-chevron-right" style="font-size:11px;"></i>
            <span>{{ $espaco->titulo }}</span>
        </div>
        <h1>{{ $espaco->titulo }}</h1>
        <div class="tags">
            @if($espaco->categoria)
            <span class="tag"><i class="bi bi-tag"></i> {{ $espaco->categoria->nome }}</span>
            @endif
            @if($espaco->horario_abertura && $espaco->horario_encerramento)
            <span class="tag"><i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($espaco->horario_abertura)->format('H:i') }} — {{ \Carbon\Carbon::parse($espaco->horario_encerramento)->format('H:i') }}</span>
            @endif
            @if($espaco->max_participantes)
            <span class="tag"><i class="bi bi-people"></i> Até {{ $espaco->max_participantes }} pessoas</span>
            @endif
            @if($espaco->localizacao)
            <span class="tag"><i class="bi bi-geo-alt"></i> {{ $espaco->localizacao }}</span>
            @endif
        </div>
    </div>
</div>

<div class="container">
    <div class="espaco-layout">

        <!-- COLUNA ESQUERDA: DETALHES -->
        <div>
            @if($espaco->descricao)
            <div class="card-section">
                <h3><i class="bi bi-info-circle"></i> Sobre este espaço</h3>
                <p style="font-size:15px; color:#555; line-height:1.8; margin:0;">{{ $espaco->descricao }}</p>
            </div>
            @endif

            <div class="card-section">
                <h3><i class="bi bi-grid"></i> Informações</h3>
                <div class="info-grid">
                    @if($espaco->horario_abertura)
                    <div class="info-item">
                        <div class="label">Horário de abertura</div>
                        <div class="value">{{ \Carbon\Carbon::parse($espaco->horario_abertura)->format('H:i') }}</div>
                    </div>
                    @endif
                    @if($espaco->horario_encerramento)
                    <div class="info-item">
                        <div class="label">Horário de encerramento</div>
                        <div class="value">{{ \Carbon\Carbon::parse($espaco->horario_encerramento)->format('H:i') }}</div>
                    </div>
                    @endif
                    @if($espaco->min_participantes)
                    <div class="info-item">
                        <div class="label">Mínimo de participantes</div>
                        <div class="value">{{ $espaco->min_participantes }}</div>
                    </div>
                    @endif
                    @if($espaco->max_participantes)
                    <div class="info-item">
                        <div class="label">Máximo de participantes</div>
                        <div class="value">{{ $espaco->max_participantes }}</div>
                    </div>
                    @endif
                    @if($espaco->periodo_max_reserva)
                    <div class="info-item">
                        <div class="label">Período máximo de reserva</div>
                        <div class="value">{{ $espaco->periodo_max_reserva }}h</div>
                    </div>
                    @endif
                    @if($espaco->responsavel)
                    <div class="info-item">
                        <div class="label">Responsável</div>
                        <div class="value">{{ $espaco->responsavel }}</div>
                    </div>
                    @endif
                </div>
            </div>

            @if($espaco->regras)
            <div class="card-section">
                <h3><i class="bi bi-clipboard-check"></i> Regras de uso</h3>
                <div class="regras-text">{{ $espaco->regras }}</div>
            </div>
            @endif

            @if($espaco->materiais)
            <div class="card-section">
                <h3><i class="bi bi-box-seam"></i> Materiais disponíveis</h3>
                <div class="regras-text">{{ $espaco->materiais }}</div>
            </div>
            @endif

            @if($espaco->observacoes)
            <div class="card-section">
                <h3><i class="bi bi-chat-square-text"></i> Observações</h3>
                <div class="regras-text">{{ $espaco->observacoes }}</div>
            </div>
            @endif
        </div>

        <!-- COLUNA DIREITA: CALENDÁRIO + RESERVA -->
        <div>
            <div class="calendar-wrap">
                <div class="calendar-header">
                    <h3><i class="bi bi-calendar3" style="color:#4a4aff; margin-right:6px;"></i> Disponibilidade</h3>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <span class="cal-month" id="cal-month-label"></span>
                        <div class="cal-nav">
                            <button id="cal-prev"><i class="bi bi-chevron-left"></i></button>
                            <button id="cal-next"><i class="bi bi-chevron-right"></i></button>
                        </div>
                    </div>
                </div>

                <div class="cal-grid" id="cal-grid">
                    <!-- Gerado por JS -->
                </div>

                <div class="cal-legend">
                    <div class="legend-item"><div class="legend-dot" style="background:#4a4aff;"></div> Hoje</div>
                    <div class="legend-item"><div class="legend-dot" style="background:#ef4444;"></div> Reservado</div>
                    <div class="legend-item"><div class="legend-dot" style="background:#d97706;"></div> Parcial</div>
                    <div class="legend-item"><div class="legend-dot" style="background:#e0dfd8;"></div> Passado</div>
                </div>

                <div class="day-selected-info" id="day-info">
                    <i class="bi bi-calendar-check"></i>
                    <strong id="day-info-text">Dia selecionado</strong>
                </div>

                <a href="#" id="btn-reservar" class="btn-reservar" style="pointer-events:none;opacity:0.5;">
                    Selecione uma data →
                </a>

                <p style="font-size:11px;color:#aaa;text-align:center;margin-top:10px;">
                    Após selecionar, você escolherá o horário na próxima tela.
                </p>
            </div>
        </div>

    </div>
</div>

<script>
const espaco_id = {{ $espaco->id }};

// Datas com reservas (injetadas pelo controller)
const reservasDatas = {!! json_encode(
    $reservas->groupBy('data')->map(function($group) {
        return $group->count();
    })
) !!};

// Calcular se uma data está cheia (ex: mais de N reservas)
const LIMITE_DIARIO = 5; // ajuste conforme lógica do projeto

const MESES = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
const DIAS_SEMANA = ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'];

let currentDate = new Date();
let currentYear = currentDate.getFullYear();
let currentMonth = currentDate.getMonth();
let selectedDate = null;

function renderCalendar() {
    const grid = document.getElementById('cal-grid');
    const label = document.getElementById('cal-month-label');
    grid.innerHTML = '';

    label.textContent = MESES[currentMonth] + ' ' + currentYear;

    // Cabeçalho dias da semana
    DIAS_SEMANA.forEach(d => {
        const cell = document.createElement('div');
        cell.className = 'cal-dow';
        cell.textContent = d;
        grid.appendChild(cell);
    });

    const firstDay = new Date(currentYear, currentMonth, 1).getDay();
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
    const today = new Date();
    today.setHours(0,0,0,0);

    for (let i = 0; i < firstDay; i++) {
        const empty = document.createElement('div');
        empty.className = 'cal-day empty';
        grid.appendChild(empty);
    }

    for (let d = 1; d <= daysInMonth; d++) {
        const date = new Date(currentYear, currentMonth, d);
        date.setHours(0,0,0,0);
        const dateStr = currentYear + '-' + String(currentMonth+1).padStart(2,'0') + '-' + String(d).padStart(2,'0');

        const cell = document.createElement('div');
        cell.className = 'cal-day';
        cell.textContent = d;

        const isPast = date < today;
        const isToday = date.getTime() === today.getTime();
        const reservaCount = reservasDatas[dateStr] || 0;
        const isFull = reservaCount >= LIMITE_DIARIO;
        const isPartial = reservaCount > 0 && !isFull;
        const isSelected = selectedDate === dateStr;

        if (isSelected) cell.classList.add('selected');
        else if (isPast) cell.classList.add('past');
        else if (isFull) cell.classList.add('reservado');
        else if (isPartial) cell.classList.add('parcial');
        else if (isToday) cell.classList.add('today');

        if (!isPast && !isFull) {
            cell.style.cursor = 'pointer';
            cell.addEventListener('click', () => selectDate(dateStr, d));
        }

        grid.appendChild(cell);
    }
}

function selectDate(dateStr, day) {
    selectedDate = dateStr;
    renderCalendar();

    const info = document.getElementById('day-info');
    const infoText = document.getElementById('day-info-text');
    const btn = document.getElementById('btn-reservar');

    const [y, m, d] = dateStr.split('-');
    const formatted = d + '/' + m + '/' + y;

    infoText.textContent = 'Data selecionada: ' + formatted;
    info.classList.add('show');

    btn.href = '/reservas/create/' + espaco_id + '?data=' + dateStr;
    btn.style.pointerEvents = 'auto';
    btn.style.opacity = '1';
    btn.textContent = 'Reservar para ' + formatted + ' →';
}

document.getElementById('cal-prev').addEventListener('click', () => {
    currentMonth--;
    if (currentMonth < 0) { currentMonth = 11; currentYear--; }
    renderCalendar();
});
document.getElementById('cal-next').addEventListener('click', () => {
    currentMonth++;
    if (currentMonth > 11) { currentMonth = 0; currentYear++; }
    renderCalendar();
});

renderCalendar();
</script>
@endsection
