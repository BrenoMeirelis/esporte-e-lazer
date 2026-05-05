@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    body { font-family: 'DM Sans', sans-serif; background: #f5f4f0; }

    /* HEADER DA CIDADE */
    .city-header {
        background: #1a1a2e;
        color: #fff;
        padding: 40px 0 80px;
        position: relative;
        overflow: hidden;
    }
    .city-header::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0; right: 0;
        height: 48px;
        background: #f5f4f0;
        border-radius: 48px 48px 0 0;
    }
    .city-header .breadcrumb-nav {
        font-size: 13px;
        color: #7070a0;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .city-header .breadcrumb-nav a { color: #9090c0; text-decoration: none; }
    .city-header .breadcrumb-nav a:hover { color: #fff; }
    .city-header h1 {
        font-family: 'Sora', sans-serif;
        font-size: 34px;
        font-weight: 700;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }
    .city-header .meta {
        color: #8080b0;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .city-header .meta span { display: flex; align-items: center; gap: 5px; }

    /* FILTROS */
    .filters-bar {
        padding: 24px 0 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .filter-pill {
        padding: 8px 18px;
        border-radius: 30px;
        border: 1.5px solid #e0dfd8;
        background: #fff;
        font-size: 13px;
        font-weight: 500;
        color: #555;
        cursor: pointer;
        transition: all 0.18s;
        white-space: nowrap;
    }
    .filter-pill:hover, .filter-pill.active {
        border-color: #4a4aff;
        color: #4a4aff;
        background: #f0f0ff;
    }
    .filter-search {
        flex: 1;
        min-width: 180px;
        position: relative;
    }
    .filter-search input {
        width: 100%;
        padding: 9px 16px 9px 40px;
        border-radius: 30px;
        border: 1.5px solid #e0dfd8;
        background: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        outline: none;
        transition: border-color 0.2s;
    }
    .filter-search input:focus { border-color: #4a4aff; }
    .filter-search .icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #aaa;
        font-size: 14px;
    }

    /* GRID DE ESPAÇOS */
    .espacos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        padding-bottom: 60px;
    }

    .espaco-card {
        background: #fff;
        border-radius: 18px;
        border: 1.5px solid #e8e7e0;
        overflow: hidden;
        transition: all 0.25s ease;
        text-decoration: none;
        display: flex;
        flex-direction: column;
    }
    .espaco-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.10);
        border-color: #d0cfff;
    }

    /* Placeholder de imagem colorido por categoria */
    .espaco-thumb {
        height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 52px;
        position: relative;
    }
    .espaco-thumb.cat-esporte { background: linear-gradient(135deg, #e8f5e9, #c8e6c9); }
    .espaco-thumb.cat-lazer   { background: linear-gradient(135deg, #fff8e1, #ffe082); }
    .espaco-thumb.cat-evento  { background: linear-gradient(135deg, #e8eaf6, #c5cae9); }
    .espaco-thumb.cat-outro   { background: linear-gradient(135deg, #fce4ec, #f8bbd9); }

    .espaco-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        background: rgba(255,255,255,0.92);
        backdrop-filter: blur(4px);
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 11px;
        font-weight: 600;
        color: #333;
        letter-spacing: 0.3px;
    }

    .espaco-disponivel {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #22c55e;
        box-shadow: 0 0 0 3px rgba(34,197,94,0.2);
    }

    .espaco-body {
        padding: 18px 20px 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .espaco-titulo {
        font-family: 'Sora', sans-serif;
        font-size: 17px;
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 8px;
        line-height: 1.3;
    }
    .espaco-descricao {
        font-size: 13px;
        color: #888;
        margin-bottom: 14px;
        line-height: 1.5;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .espaco-meta {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        margin-bottom: 16px;
    }
    .espaco-meta-item {
        font-size: 12px;
        color: #666;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .espaco-meta-item i { color: #4a4aff; font-size: 13px; }

    .btn-ver-espaco {
        display: block;
        text-align: center;
        padding: 11px;
        background: #1a1a2e;
        color: #fff;
        border-radius: 10px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-ver-espaco:hover { background: #4a4aff; color: #fff; }

    /* EMPTY STATE */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #aaa;
        grid-column: 1 / -1;
    }
    .empty-state .icon { font-size: 56px; margin-bottom: 16px; }
    .empty-state p { font-size: 16px; }

    /* COUNTER */
    .results-count {
        font-size: 13px;
        color: #888;
        margin-bottom: 20px;
    }
    .results-count strong { color: #1a1a2e; }

    @media(max-width: 640px) {
        .city-header h1 { font-size: 24px; }
        .espacos-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="city-header">
    <div class="container">
        <div class="breadcrumb-nav">
            <a href="{{ route('cidades.index') }}"><i class="bi bi-grid-3x3-gap"></i> Cidades</a>
            <i class="bi bi-chevron-right" style="font-size:11px;"></i>
            <span>{{ $cidade->nome }}</span>
        </div>
        <h1>{{ $cidade->nome }} <span style="color:#6060a0; font-size:22px;">— {{ $cidade->uf }}</span></h1>
        <div class="meta">
            <span><i class="bi bi-buildings"></i> {{ $espacos->count() }} espaço{{ $espacos->count() != 1 ? 's' : '' }} disponível</span>
            @if($cidade->email)
            <span><i class="bi bi-envelope"></i> {{ $cidade->email }}</span>
            @endif
        </div>
    </div>
</div>

<div class="container">

    <!-- FILTROS -->
    <div class="filters-bar">
        <div class="filter-search">
            <i class="bi bi-search icon"></i>
            <input type="text" id="busca-espaco" placeholder="Buscar espaço...">
        </div>
        <button class="filter-pill active" data-cat="">Todos</button>
        @foreach($espacos->pluck('categoria.nome')->unique()->filter() as $cat)
        <button class="filter-pill" data-cat="{{ strtolower($cat) }}">{{ $cat }}</button>
        @endforeach
    </div>

    <p class="results-count" id="count-result">
        Mostrando <strong>{{ $espacos->count() }}</strong> espaço{{ $espacos->count() != 1 ? 's' : '' }}
    </p>

    <!-- GRID -->
    <div class="espacos-grid" id="espacos-grid">
        @forelse($espacos as $espaco)
        @php
            $catNome = strtolower($espaco->categoria->nome ?? '');
            $catClass = str_contains($catNome, 'esporte') || str_contains($catNome, 'futebol') || str_contains($catNome, 'quadra') ? 'cat-esporte'
                      : (str_contains($catNome, 'lazer') || str_contains($catNome, 'área') ? 'cat-lazer'
                      : (str_contains($catNome, 'salão') || str_contains($catNome, 'evento') ? 'cat-evento' : 'cat-outro'));
            $emoji = $catClass === 'cat-esporte' ? '⚽' : ($catClass === 'cat-lazer' ? '🌳' : ($catClass === 'cat-evento' ? '🎉' : '🏛️'));
        @endphp
        <div class="espaco-card" data-titulo="{{ strtolower($espaco->titulo) }}" data-cat="{{ strtolower($espaco->categoria->nome ?? '') }}">
            <div class="espaco-thumb {{ $catClass }}">
                {{ $emoji }}
                <span class="espaco-badge">{{ $espaco->categoria->nome ?? 'Sem categoria' }}</span>
                <span class="espaco-disponivel" title="Disponível para reserva"></span>
            </div>
            <div class="espaco-body">
                <div class="espaco-titulo">{{ $espaco->titulo }}</div>
                @if($espaco->descricao)
                <div class="espaco-descricao">{{ $espaco->descricao }}</div>
                @endif
                <div class="espaco-meta">
                    @if($espaco->horario_abertura && $espaco->horario_encerramento)
                    <div class="espaco-meta-item">
                        <i class="bi bi-clock"></i>
                        {{ \Carbon\Carbon::parse($espaco->horario_abertura)->format('H:i') }} — {{ \Carbon\Carbon::parse($espaco->horario_encerramento)->format('H:i') }}
                    </div>
                    @endif
                    @if($espaco->max_participantes)
                    <div class="espaco-meta-item">
                        <i class="bi bi-people"></i>
                        Até {{ $espaco->max_participantes }} pessoas
                    </div>
                    @endif
                    @if($espaco->localizacao)
                    <div class="espaco-meta-item">
                        <i class="bi bi-geo-alt"></i>
                        {{ $espaco->localizacao }}
                    </div>
                    @endif
                </div>
                <a href="{{ route('espacos.show', $espaco->id) }}" class="btn-ver-espaco">
                    Ver espaço e reservar →
                </a>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="icon">🏟️</div>
            <p>Nenhum espaço cadastrado nesta cidade ainda.</p>
        </div>
        @endforelse
    </div>
</div>

<script>
    const input = document.getElementById('busca-espaco');
    const cards = document.querySelectorAll('.espaco-card');
    const countEl = document.getElementById('count-result');
    let catAtiva = '';

    function filtrar() {
        const q = input.value.toLowerCase().trim();
        let count = 0;
        cards.forEach(card => {
            const titulo = card.dataset.titulo;
            const cat = card.dataset.cat;
            const matchQ = titulo.includes(q);
            const matchC = !catAtiva || cat.includes(catAtiva);
            const show = matchQ && matchC;
            card.style.display = show ? 'flex' : 'none';
            if (show) count++;
        });
        countEl.innerHTML = 'Mostrando <strong>' + count + '</strong> espaço' + (count !== 1 ? 's' : '');

        let empty = document.getElementById('empty-search');
        if (count === 0) {
            if (!empty) {
                empty = document.createElement('div');
                empty.id = 'empty-search';
                empty.className = 'empty-state';
                empty.style.gridColumn = '1 / -1';
                empty.innerHTML = '<div class="icon">🔍</div><p>Nenhum espaço encontrado.</p>';
                document.getElementById('espacos-grid').appendChild(empty);
            }
        } else if (empty) {
            empty.remove();
        }
    }

    input.addEventListener('input', filtrar);

    document.querySelectorAll('.filter-pill').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.filter-pill').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            catAtiva = this.dataset.cat;
            filtrar();
        });
    });
</script>
@endsection
