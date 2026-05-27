@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: #f5f4f0;
        }

        .page-hero {
            background: #1a1a2e;
            color: #fff;
            padding: 56px 0 40px;
            margin-bottom: 0;
        }

        .page-hero h1 {
            font-family: 'Sora', sans-serif;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .page-hero p {
            color: #a0a0c0;
            font-size: 16px;
            margin: 0;
        }

        /* SEARCH BAR */
        .search-section {
            background: #1a1a2e;
            padding-bottom: 0;
        }

        .search-box {
            background: #fff;
            border-radius: 16px 16px 0 0;
            padding: 28px 32px 0;
            box-shadow: 0 -4px 24px rgba(0, 0, 0, 0.08);
        }

        .search-wrap {
            position: relative;
            margin-bottom: 0;
        }

        .search-wrap input {
            width: 100%;
            padding: 16px 20px 16px 52px;
            border: 1.5px solid #e0dfd8;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            background: #fafaf8;
            color: #1a1a2e;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .search-wrap input:focus {
            border-color: #4a4aff;
            box-shadow: 0 0 0 3px rgba(74, 74, 255, 0.1);
            background: #fff;
        }

        .search-wrap input::placeholder {
            color: #aaa;
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 20px;
            pointer-events: none;
        }

        /* TABS */
        .tab-bar {
            display: flex;
            gap: 4px;
            padding: 20px 32px 0;
            background: #fff;
        }

        .tab-btn {
            padding: 10px 20px;
            border-radius: 8px 8px 0 0;
            border: none;
            background: transparent;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            color: #888;
            cursor: pointer;
            transition: all 0.2s;
            border-bottom: 2px solid transparent;
        }

        .tab-btn.active {
            color: #4a4aff;
            border-bottom-color: #4a4aff;
            background: #f0f0ff;
        }

        /* MAIN CONTENT */
        .content-area {
            background: #fff;
            padding: 28px 32px 40px;
            min-height: 400px;
        }

        .section-label {
            font-family: 'Sora', sans-serif;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.5px;
            color: #aaa;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        /* CITY GRID */
        .city-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 14px;
            margin-bottom: 36px;
        }

        .city-card {
            border: 1.5px solid #e8e7e0;
            border-radius: 14px;
            background: #fafaf8;
            position: relative;
            overflow: hidden;
            transition: all 0.22s ease;
        }

        .city-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #4a4aff08, #00c8a008);
            opacity: 0;
            transition: opacity 0.2s;
            border-radius: inherit;
            pointer-events: none;
        }

        .city-card:hover {
            border-color: #4a4aff;
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(74, 74, 255, 0.12);
            background: #fff;
        }

        .city-card:hover::before {
            opacity: 1;
        }

        .city-card-link {
            padding: 20px 18px;
            text-decoration: none;
            display: block;
            color: inherit;
            min-height: 100%;
            position: relative;
            z-index: 1;
        }

        .city-icon {
            width: 40px;
            height: 40px;
            background: #ededff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 12px;
        }

        .city-name {
            font-family: 'Sora', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 4px;
        }

        .city-uf {
            font-size: 12px;
            color: #888;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .city-uf .badge-uf {
            background: #f0f0f0;
            padding: 2px 8px;
            border-radius: 20px;
            font-weight: 500;
            color: #555;
        }

        .city-count {
            position: absolute;
            top: 16px;
            right: 56px;
            font-size: 11px;
            color: #4a4aff;
            font-weight: 600;
            background: #f0f0ff;
            padding: 3px 8px;
            border-radius: 20px;
            z-index: 1;
        }

        .city-arrow {
            position: absolute;
            bottom: 18px;
            right: 18px;
            color: #ccc;
            font-size: 18px;
            transition: all 0.2s;
            z-index: 1;
        }

        .city-card:hover .city-arrow {
            color: #4a4aff;
            transform: translateX(4px);
        }

        .city-edit-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 3;
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: #4a4aff;
            border: 1px solid #e5e5ff;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .city-edit-btn:hover {
            background: #4a4aff;
            color: #fff;
            transform: scale(1.05);
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #aaa;
        }

        .empty-state .icon {
            font-size: 48px;
            margin-bottom: 12px;
        }

        .empty-state p {
            font-size: 15px;
        }

        /* ALERT */
        .alert-success {
            background: #e8f8f0;
            border: 1px solid #b5e8d0;
            color: #1a7a50;
            border-radius: 10px;
            padding: 12px 18px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @media(max-width: 640px) {
            .page-hero {
                padding: 36px 0 24px;
            }

            .page-hero h1 {
                font-size: 26px;
            }

            .search-box,
            .tab-bar,
            .content-area {
                padding-left: 16px;
                padding-right: 16px;
            }

            .city-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>

    <div class="page-hero">
        <div class="container">
            <h1>Olá, {{ auth()->user()->name }}! 👋</h1>
            <p>Escolha uma cidade para ver os espaços disponíveis para reserva.</p>
        </div>
    </div>

    <div class="search-section">
        <div class="container">
            <div class="search-box">
                <div class="search-wrap">
                    <span class="search-icon">
                        <i class="bi bi-search"></i>
                    </span>

                    <input type="text" id="busca-cidade" placeholder="Buscar cidade por nome..." autocomplete="off">
                </div>
            </div>

            <div class="tab-bar">
                <button class="tab-btn active" data-tab="todas">
                    Todas as cidades
                </button>

                @if (auth()->user()->cidades && auth()->user()->cidades->count() > 0)
                    <button class="tab-btn" data-tab="minhas">
                        Minhas cidades
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div style="background:#fff;">
        <div class="container">
            <div class="content-area">

                @if (session('success'))
                    <div class="alert-success">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <div id="tab-todas">

                    <div class="d-flex align-items-center mb-3">
                        <p class="section-label mb-0">
                            {{ $cidades->count() }}
                            cidade{{ $cidades->count() != 1 ? 's' : '' }}
                            disponível
                        </p>

                        @can('create', App\Models\Cidade::class)
                            <a class="btn btn-success ms-auto" href="{{ route('cidades.create') }}">
                                + Nova Cidade
                            </a>
                        @endcan
                    </div>

                    @if ($cidades->isEmpty())
                        <div class="empty-state">
                            <div class="icon">🏙️</div>
                            <p>Nenhuma cidade cadastrada ainda.</p>
                        </div>
                    @else
                        <div class="city-grid" id="grid-cidades">

                            @foreach ($cidades as $cidade)
                                <div class="city-card" data-nome="{{ strtolower($cidade->nome) }}">

                                    <a href="{{ route('espacos.index', $cidade->id) }}" class="city-card-link">
                                        <div class="city-icon">🏙️</div>

                                        <div class="city-name">
                                            {{ $cidade->nome }}
                                        </div>

                                        <div class="city-uf">
                                            <span class="badge-uf">
                                                {{ $cidade->uf }}
                                            </span>

                                            {{ $cidade->espacos_count ?? $cidade->espacos->count() }}
                                            espaço(s)
                                        </div>

                                        <span class="city-count">
                                            Ver espaços
                                        </span>

                                        <span class="city-arrow">
                                            <i class="bi bi-arrow-right"></i>
                                        </span>
                                    </a>

                                    @can('manageAdmins', $cidade)
                                        <a class="city-edit-btn" href="{{ route('cidades.show', $cidade->id) }}"
                                            title="Gerenciar cidade">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    @endcan

                                </div>
                            @endforeach

                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script>
        const input = document.getElementById('busca-cidade');
        const cards = document.querySelectorAll('.city-card');

        input.addEventListener('input', function() {

            const q = this.value.toLowerCase().trim();

            let found = 0;

            cards.forEach(card => {

                const nome = card.dataset.nome;

                const show = nome.includes(q);

                card.style.display = show ? 'block' : 'none';

                if (show) {
                    found++;
                }
            });

            const grid = document.getElementById('grid-cidades');

            let empty = grid.querySelector('.empty-search');

            if (found === 0 && q) {

                if (!empty) {

                    empty = document.createElement('div');

                    empty.className = 'empty-search empty-state';

                    empty.innerHTML =
                        '<div class="icon">🔍</div><p>Nenhuma cidade encontrada para "<strong>' +
                        q +
                        '</strong>"</p>';

                    grid.appendChild(empty);
                }

            } else if (empty) {

                empty.remove();
            }
        });

        // Tabs
        document.querySelectorAll('.tab-btn').forEach(btn => {

            btn.addEventListener('click', function() {

                document
                    .querySelectorAll('.tab-btn')
                    .forEach(b => b.classList.remove('active'));

                this.classList.add('active');
            });
        });
    </script>
@endsection
