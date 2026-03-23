<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sistema') }}</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        .navbar-nav .nav-link:hover {
            color: #198754 !important;
        }

        .btn-link.nav-link:hover {
            color: #dc3545 !important;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            {{ config('app.name', 'Sistema') }}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            {{-- MENU ESQUERDA --}}
            <ul class="navbar-nav me-auto">

                {{-- Home --}}
                @if(Route::has('home'))
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('home') }}">
                        <i class="bi bi-house-door-fill me-1"></i> Home
                    </a>
                </li>
                @endif

                {{-- Usuários --}}
                @auth
                    @if(Route::has('users.index'))
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('users.index') }}">
                            <i class="bi bi-people-fill me-1"></i> Usuários
                        </a>
                    </li>
                    @endif

                    @if(Route::has('users.create'))
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('users.create') }}">
                            <i class="bi bi-person-plus-fill me-1"></i> Criar Usuário
                        </a>
                    </li>
                    @endif
                @endauth

                {{-- Espaços --}}
                @php
                    $cidadeDefault = \App\Models\Cidade::first();
                @endphp

                @if ($cidadeDefault && Route::has('espacos.index'))
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center"
                           href="{{ route('espacos.index', ['cidade_id' => $cidadeDefault->id]) }}">
                            <i class="bi bi-building me-1"></i> Espaços
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <span class="nav-link text-muted d-flex align-items-center">
                            <i class="bi bi-building me-1"></i> Espaços
                        </span>
                    </li>
                @endif

                {{-- Reservas --}}
                @auth
                    @if(Route::has('reservas.index'))
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('reservas.index') }}">
                            <i class="bi bi-calendar-check-fill me-1"></i> Reservas
                        </a>
                    </li>
                    @endif
                @endauth

                {{-- Cidades --}}
                @auth
                    @if(Route::has('cidades.index'))
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('cidades.index') }}">
                            <i class="bi bi-geo-alt-fill me-1"></i> Cidades
                        </a>
                    </li>
                    @endif
                @endauth

            </ul>

            {{-- MENU DIREITA --}}
            <ul class="navbar-nav ms-auto">

                @auth
                    <li class="nav-item">
                        <span class="nav-link text-white">
                            <i class="bi bi-person-circle me-1"></i>
                            {{ auth()->user()->name }}
                        </span>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link d-flex align-items-center p-0">
                                <i class="bi bi-box-arrow-right me-1"></i> Sair
                            </button>
                        </form>
                    </li>
                @endauth

                @guest
                    @if(Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                    </li>
                    @endif
                @endguest

            </ul>
        </div>
    </div>
</nav>

<main class="py-4">
    <div class="container">
        @yield('content')
    </div>
</main>

<footer class="bg-light text-center py-3 mt-5">
    <small>
        &copy; {{ date('Y') }} {{ config('app.name', 'Sistema') }} - Todos os direitos reservados
    </small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
