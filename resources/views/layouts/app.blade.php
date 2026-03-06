<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sistema') }}</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Sistema') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.create') }}">
                            Criar Usuário
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">
                            Listar Usuários
                        </a>
                    </li>
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

<ul class="navbar-nav ms-auto">

    @auth

    <li class="nav-item">
    <a class="nav-link" href="{{ route('users.index') }}">
    Listar Usuários
    </a>
    </li>

    <li class="nav-item">
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="btn btn-link nav-link">
    Sair
    </button>
    </form>
    </li>

    @endauth

    @guest

    <li class="nav-item">
    <a class="nav-link" href="{{ route('login') }}">
    Login
    </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">Home</a>
    </li>

    @endguest

    </ul>
