@extends('layouts.app')

@section('content')
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">

    <style>
        /* BODY FONTS */
        body {
            font-family: 'Roboto', sans-serif;
        }

        /* HERO MODERNO COM GRADIENTE */
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)), url('https://images.unsplash.com/photo-1477959858617-67f85cf4f1df') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 140px 30px;
            border-radius: 20px;
            text-align: center;
            margin-bottom: 60px;
            text-shadow: 0 2px 15px rgba(0, 0, 0, 0.6);
        }

        .hero h1 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 50px;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }

        .hero p {
            font-size: 20px;
            line-height: 1.7;
        }

        /* BOTÃO CALENDÁRIO */
        .btn-calendario {
            display: inline-block;
            margin: 25px auto 40px;
            background: #0d6efd;
            color: white;
            font-weight: 600;
            padding: 12px 28px;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-calendario:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            text-decoration: none;
        }

        /* SEÇÃO TÍTULO */
        .section-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 32px;
            margin-bottom: 50px;
            text-align: center;
            color: #212529;
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 120px;
            height: 3px;
            background: #0d6efd;
            margin: 12px auto 0;
            border-radius: 2px;
        }

        /* CARDS SERVIÇOS */
        .servico {
            background: #ffffff;
            padding: 30px 20px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            cursor: pointer;
            transition: all 0.4s ease;
            opacity: 0;
            transform: translateY(50px);
        }

        .servico.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .servico:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.18);
            background: #f0f8ff;
        }

        .servico h5 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 12px;
        }

        .servico p {
            color: #6c757d;
            font-size: 15px;
            flex-grow: 1;
        }

        /* ICONS */
        .servico i {
            font-size: 40px;
            margin-bottom: 15px;
            color: #0d6efd;
            transition: transform 0.3s ease;
        }

        .servico:hover i {
            transform: rotate(15deg) scale(1.2);
        }

        /* SOBRE */
        .sobre {
            max-width: 800px;
            margin: auto;
            font-size: 17px;
            line-height: 1.9;
            color: #495057;
        }

        /* RESPONSIVO */
        @media(max-width:768px) {
            .hero h1 {
                font-size: 38px;
            }

            .hero p {
                font-size: 18px;
            }
        }
    </style>

    {{-- HERO --}}
    <div class="container">
        <div class="hero">
            <h1>Prefeitura Municipal</h1>
            <p>Sistema moderno de reservas de espaços públicos. Campos de futebol, quadras esportivas, salões e áreas de
                lazer disponíveis para toda a população.</p>
        </div>

        {{-- SERVIÇOS --}}
        <h3 class="section-title">Serviços Disponíveis</h3>
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <a href="#" class="text-decoration-none">
                    <div class="servico">
                        <i class="bi bi-basket"></i>
                        <h5>Campos de Futebol</h5>
                        <p>Reserve campos municipais para jogos e campeonatos.</p>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="#" class="text-decoration-none">
                    <div class="servico">
                        <i class="bi bi-volleyball"></i>
                        <h5>Quadras Esportivas</h5>
                        <p>Espaços para futsal, vôlei e atividades esportivas.</p>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="#" class="text-decoration-none">
                    <div class="servico">
                        <i class="bi bi-building"></i>
                        <h5>Salões de Evento</h5>
                        <p>Salões comunitários para eventos da população.</p>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="#" class="text-decoration-none">
                    <div class="servico">
                        <i class="bi bi-people"></i>
                        <h5>Áreas de Lazer</h5>
                        <p>Espaços públicos para recreação e convivência.</p>
                    </div>
                </a>
            </div>
        </div>

        {{-- SOBRE --}}
        <div class="mt-5 text-center">
            <h3 class="section-title">Sobre o Sistema</h3>
            <p class="sobre">
                Este sistema foi desenvolvido para facilitar o acesso da população aos espaços públicos da cidade. Através
                da plataforma, é possível visualizar locais disponíveis e realizar reservas de forma rápida e organizada,
                garantindo melhor utilização dos recursos da prefeitura.
            </p>
        </div>
    </div>

    {{-- BOOTSTRAP ICONS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    {{-- SCRIPT DE ANIMAÇÃO SCROLL --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.servico');

            function checkVisibility() {
                const triggerBottom = window.innerHeight * 0.85;
                cards.forEach(card => {
                    const cardTop = card.getBoundingClientRect().top;
                    if (cardTop < triggerBottom) {
                        card.classList.add('visible');
                    }
                });
            }
            window.addEventListener('scroll', checkVisibility);
            checkVisibility();
        });
    </script>
@endsection
