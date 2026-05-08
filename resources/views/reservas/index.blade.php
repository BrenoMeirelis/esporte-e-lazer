@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: #f5f4f0;
        }

        .page-hero {
            background: #1a1a2e;
            color: #fff;
            padding: 44px 0 76px;
            position: relative;
            overflow: hidden;
        }

        .page-hero::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 48px;
            background: #f5f4f0;
            border-radius: 48px 48px 0 0;
        }

        .page-hero h1 {
            font-family: 'Sora', sans-serif;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .page-hero p {
            color: #8080b0;
            font-size: 15px;
            margin: 0;
        }

        /* STATS */
        .stats-row {
            display: flex;
            gap: 14px;
            margin-bottom: 28px;
            flex-wrap: wrap;
        }

        .stat-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fff;
            border: 1.5px solid #e8e7e0;
            border-radius: 40px;
            padding: 10px 18px;
            font-size: 14px;
            color: #444;
        }

        .stat-pill .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .stat-pill strong {
            font-weight: 600;
            color: #1a1a2e;
        }

        /* FILTROS */
        .filter-bar {
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 8px 18px;
            border-radius: 30px;
            border: 1.5px solid #e0dfd8;
            background: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            color: #666;
            cursor: pointer;
            transition: all 0.18s;
        }

        .filter-btn.active {
            border-color: #4a4aff;
            color: #4a4aff;
            background: #f0f0ff;
        }

        .filter-btn[data-status="pendente"].active {
            border-color: #d97706;
            color: #d97706;
            background: #fef3c7;
        }

        .filter-btn[data-status="aprovada"].active {
            border-color: #16a34a;
            color: #16a34a;
            background: #dcfce7;
        }

        .filter-btn[data-status="recusada"].active {
            border-color: #dc2626;
            color: #dc2626;
            background: #fee2e2;
        }

        /* LISTA DE RESERVAS */
        .reservas-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
            padding-bottom: 60px;
        }

        .reserva-card {
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid #e8e7e0;
            overflow: hidden;
            transition: all 0.2s;
            display: flex;
            text-decoration: none;
            color: inherit;
        }

        .reserva-card:hover {
            border-color: #d0cfff;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.07);
            transform: translateY(-2px);
        }

        /* BARRA LATERAL DE STATUS */
        .reserva-status-bar {
            width: 6px;
            flex-shrink: 0;
        }

        .status-pendente .reserva-status-bar {
            background: #f59e0b;
        }

        .status-aprovada .reserva-status-bar {
            background: #22c55e;
        }

        .status-recusada .reserva-status-bar {
            background: #ef4444;
        }

        .reserva-content {
            flex: 1;
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* DATA */
        .reserva-data-box {
            text-align: center;
            min-width: 52px;
            background: #fafaf8;
            border-radius: 12px;
            padding: 10px 12px;
            border: 1px solid #f0efe8;
            flex-shrink: 0;
        }

        .reserva-data-box .dia {
            font-family: 'Sora', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: #1a1a2e;
            line-height: 1;
        }

        .reserva-data-box .mes {
            font-size: 11px;
            color: #aaa;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 3px;
        }

        /* INFO */
        .reserva-info {
            flex: 1;
        }

        .reserva-espaco {
            font-family: 'Sora', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 4px;
        }

        .reserva-meta {
            font-size: 13px;
            color: #888;
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .reserva-meta span {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* BADGE STATUS */
        .status-badge {
            flex-shrink: 0;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .badge-pendente {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-aprovada {
            background: #dcfce7;
            color: #14532d;
        }

        .badge-recusada {
            background: #fee2e2;
            color: #7f1d1d;
        }

        /* AÇÃO */
        .reserva-action {
            display: flex;
            align-items: center;
            padding-right: 20px;
            color: #ccc;
            font-size: 18px;
            flex-shrink: 0;
        }

        .reserva-card:hover .reserva-action {
            color: #4a4aff;
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #bbb;
        }

        .empty-state .icon {
            font-size: 56px;
            margin-bottom: 16px;
        }

        .empty-state h3 {
            font-family: 'Sora', sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: #888;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .btn-nova-reserva {
            display: inline-block;
            padding: 12px 24px;
            background: #1a1a2e;
            color: #fff;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-nova-reserva:hover {
            background: #4a4aff;
            color: #fff;
        }

        @media(max-width: 640px) {
            .reserva-content {
                flex-wrap: wrap;
                gap: 12px;
            }

            .reserva-data-box {
                display: none;
            }

            .status-badge {
                font-size: 11px;
            }
        }
    </style>

    <div class="page-hero">
        <div class="container">
            <h1>Minhas Reservas</h1>
            <p>Acompanhe o status das suas reservas de espaços.</p>
        </div>
    </div>

    <div class="container" style="padding-top: 28px;">

        @if (session('success'))
            <div
                style="background:#e8f8f0;border:1px solid #b5e8d0;color:#1a7a50;border-radius:10px;padding:12px 18px;margin-bottom:20px;font-size:14px;display:flex;align-items:center;gap:8px;">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('sucesso'))
            <div
                style="background:#e8f8f0;border:1px solid #b5e8d0;color:#1a7a50;border-radius:10px;padding:12px 18px;margin-bottom:20px;font-size:14px;display:flex;align-items:center;gap:8px;">
                <i class="bi bi-check-circle-fill"></i> {{ session('sucesso') }}
            </div>
        @endif

        @php
            $pendentes = $reservas->where('status', 'pendente')->count();
            $aprovadas = $reservas->where('status', 'aprovada')->count();
            $recusadas = $reservas->where('status', 'recusada')->count();
        @endphp

        <!-- STATS -->
        <div class="stats-row">
            <div class="stat-pill">
                <div class="dot" style="background:#6b7280;"></div>
                <strong>{{ $reservas->count() }}</strong> total
            </div>
            @if ($pendentes > 0)
                <div class="stat-pill">
                    <div class="dot" style="background:#f59e0b;"></div>
                    <strong>{{ $pendentes }}</strong> aguardando
                </div>
            @endif
            @if ($aprovadas > 0)
                <div class="stat-pill">
                    <div class="dot" style="background:#22c55e;"></div>
                    <strong>{{ $aprovadas }}</strong> aprovada{{ $aprovadas != 1 ? 's' : '' }}
                </div>
            @endif
            @if ($recusadas > 0)
                <div class="stat-pill">
                    <div class="dot" style="background:#ef4444;"></div>
                    <strong>{{ $recusadas }}</strong> recusada{{ $recusadas != 1 ? 's' : '' }}
                </div>
            @endif
        </div>

        <!-- FILTROS -->
        <div class="filter-bar">
            <button class="filter-btn active" data-status="">Todas</button>
            <button class="filter-btn" data-status="pendente">⏳ Pendentes</button>
            <button class="filter-btn" data-status="aprovada">✅ Aprovadas</button>
            <button class="filter-btn" data-status="recusada">❌ Recusadas</button>
        </div>

        <!-- LISTA -->
        <div class="reservas-list" id="reservas-list">
            @forelse($reservas->sortByDesc('data') as $reserva)
                @php
                    $status = $reserva->status ?? 'pendente';
                    $data = \Carbon\Carbon::parse($reserva->data);
                @endphp
                <a href="{{ route('reservas.show', $reserva->id) }}" class="reserva-card status-{{ $status }}"
                    data-status="{{ $status }}">
                    <div class="reserva-status-bar"></div>
                    <div class="reserva-content">
                        <div class="reserva-data-box">
                            <div class="dia">{{ $data->format('d') }}</div>
                            <div class="mes">{{ $data->translatedFormat('M') }}</div>
                        </div>
                        <div class="reserva-info">
                            <div class="reserva-espaco">{{ $reserva->espaco->titulo ?? 'Espaço removido' }}</div>
                            <div class="reserva-meta">
                                <span><i class="bi bi-calendar3"></i> {{ $data->format('d/m/Y') }}</span>
                                <span><i class="bi bi-clock"></i>
                                    {{ \Carbon\Carbon::parse($reserva->hora_inicio)->format('H:i') }} —
                                    {{ \Carbon\Carbon::parse($reserva->hora_fim)->format('H:i') }}</span>
                                @if ($reserva->espaco && $reserva->espaco->cidade)
                                    <span><i class="bi bi-geo-alt"></i> {{ $reserva->espaco->cidade->nome }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="status-badge badge-{{ $status }}">
                            @if ($status === 'pendente')
                                <i class="bi bi-hourglass-split"></i> Aguardando
                            @elseif($status === 'aprovada')
                                <i class="bi bi-check-circle-fill"></i> Aprovada
                            @elseif($status === 'recusada')
                                <i class="bi bi-x-circle-fill"></i> Recusada
                            @else
                                <i class="bi bi-hourglass-split"></i> Pendente
                            @endif
                        </div>
                    </div>
                    <div class="reserva-action">
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </a>
            @empty
                <div class="empty-state">
                    <div class="icon">📅</div>
                    <h3>Nenhuma reserva ainda</h3>
                    <p>Você ainda não fez nenhuma reserva. Escolha um espaço e comece agora!</p>
                    <a href="{{ route('cidades.index') }}" class="btn-nova-reserva">
                        Explorar espaços →
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const status = this.dataset.status;
                const cards = document.querySelectorAll('.reserva-card');
                let count = 0;

                cards.forEach(card => {
                    const show = !status || card.dataset.status === status;
                    card.style.display = show ? 'flex' : 'none';
                    if (show) count++;
                });

                // Mostrar empty state se necessário
                const list = document.getElementById('reservas-list');
                let emptyEl = list.querySelector('.filter-empty');
                if (count === 0 && cards.length > 0) {
                    if (!emptyEl) {
                        emptyEl = document.createElement('div');
                        emptyEl.className = 'empty-state filter-empty';
                        emptyEl.innerHTML =
                            '<div class="icon">🔍</div><h3>Nenhuma reserva neste filtro</h3>';
                        list.appendChild(emptyEl);
                    }
                } else if (emptyEl) {
                    emptyEl.remove();
                }
            });
        });
    </script>
@endsection
