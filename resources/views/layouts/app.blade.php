<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sistema') }}</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        /* Navbar hover efeito */
        .navbar-nav .nav-link:hover {
            color: #198754 !important; /* verde bootstrap */
        }
        .btn-link.nav-link:hover {
            color: #dc3545 !important; /* vermelho para Sair */
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                {{ config('app.name', 'Sistema') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    {{-- Home --}}
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('home') }}">
                            <i class="bi bi-house-door-fill me-1"></i> Home
                        </a>
                    </li>

                    {{-- Usuários --}}
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('users.index') }}">
                            <i class="bi bi-people-fill me-1"></i> Usuários
                        </a>
                    </li>

                    {{-- Criar Usuário --}}
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('users.create') }}">
                            <i class="bi bi-person-plus-fill me-1"></i> Criar Usuário
                        </a>
                    </li>

                    {{-- Espaços --}}
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('espacos.index') }}">
                            <i class="bi bi-building me-1"></i> Espaços
                        </a>
                    </li>

                    {{-- Reservas --}}
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('reservas.index') }}">
                            <i class="bi bi-calendar-check-fill me-1"></i> Reservas
                        </a>
                    </li>

                    {{-- Cidades --}}
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('cidades.index') }}">
                            <i class="bi bi-geo-alt-fill me-1"></i> Cidades
                        </a>
                    </li>
                </ul>

                {{-- Links à direita --}}
                <ul class="navbar-nav ms-auto">
                    @auth
                        {{-- Sair --}}
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link d-flex align-items-center p-0">
                                    <i class="bi bi-box-arrow-right me-1"></i> Sair
                                </button>
                            </form>
                        </li>
                    @endauth

                    @guest
                        {{-- Login --}}
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- Conteúdo --}}
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-light text-center py-3 mt-5">
        <small>
            &copy; {{ date('Y') }} {{ config('app.name', 'Sistema') }} - Todos os direitos reservados
        </small>
    </footer>

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
