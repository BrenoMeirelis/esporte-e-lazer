<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sistema') }}</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Icons --}}
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

                {{-- ESQUERDA --}}
                <ul class="navbar-nav me-auto">

                    {{-- HOME --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="bi bi-house-door-fill"></i> Home
                        </a>
                    </li>

                    {{-- USUÁRIOS (SÓ ADMIN) --}}
                    @auth
                        @if (in_array(auth()->user()->tipo, ['admin', 'super_admin']))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.index') }}">
                                    <i class="bi bi-people-fill"></i> Usuários
                                </a>
                            </li>
                        @endif
                    @endauth

                    {{-- CRIAR USUÁRIO (LIBERADO) --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.create') }}">
                            <i class="bi bi-person-plus-fill"></i> Criar Usuário
                        </a>
                    </li>

                    {{-- ESPAÇOS --}}
                    @php
                        $cidadeDefault = \App\Models\Cidade::first();
                    @endphp

                    @if ($cidadeDefault)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('espacos.index', ['cidade' => $cidadeDefault->id]) }}">
                                <i class="bi bi-building"></i> Espaços
                            </a>
                        </li>
                    @endif

                    {{-- RESERVAS --}}
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reservas.index') }}">
                                <i class="bi bi-calendar-check-fill"></i> Reservas
                            </a>
                        </li>
                    @endauth

                    {{-- CALENDÁRIO --}}
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('calendario') }}">
                                <i class="bi bi-calendar-event-fill"></i> Calendário
                            </a>
                        </li>
                    @endauth

                    {{-- CIDADES --}}
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cidades.index') }}">
                                <i class="bi bi-geo-alt-fill"></i> Cidades
                            </a>
                        </li>
                    @endauth

                </ul>

                {{-- DIREITA --}}
                <ul class="navbar-nav ms-auto align-items-center">

                    @auth
                        <li class="nav-item">
                            <a href="{{ route('users.show', auth()->user()->id) }}" class="nav-link text-white">
                                <i class="bi bi-person-circle"></i>
                                {{ auth()->user()->name }}
                            </a>
                        </li>

                        <li class="nav-item ms-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-white p-0"
                                    style="text-decoration: none;">
                                    <i class="bi bi-box-arrow-right"></i> Sair
                                </button>
                            </form>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                        </li>
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
            &copy; {{ date('Y') }} {{ config('app.name', 'Sistema') }}
        </small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
