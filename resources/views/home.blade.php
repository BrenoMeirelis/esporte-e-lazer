@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>

body{
    font-family:'DM Sans',sans-serif;
    background:#f5f4f0;
}

.hero{
    background:#1a1a2e;
    border-radius:0 0 48px 48px;
    padding:90px 20px 120px;
    color:#fff;
    text-align:center;
    position:relative;
    overflow:hidden;
}

.hero::before{
    content:'';
    position:absolute;
    width:500px;
    height:500px;
    background:rgba(74,74,255,.18);
    border-radius:50%;
    top:-200px;
    right:-120px;
}

.hero h1{
    font-family:'Sora',sans-serif;
    font-size:56px;
    font-weight:700;
    margin-bottom:20px;
    position:relative;
}

.hero p{
    max-width:760px;
    margin:auto;
    color:#b7b7d7;
    font-size:18px;
    line-height:1.8;
    position:relative;
}

.hero-btn{
    display:inline-block;
    margin-top:35px;
    background:#4a4aff;
    color:#fff;
    padding:15px 28px;
    border-radius:14px;
    text-decoration:none;
    font-weight:600;
    transition:.2s;
}

.hero-btn:hover{
    background:#6366ff;
    transform:translateY(-3px);
}

.section{
    padding:70px 0;
}

.section-title{
    font-family:'Sora',sans-serif;
    font-size:34px;
    font-weight:700;
    margin-bottom:50px;
    color:#1a1a2e;
}

.service-card{
    background:#fff;
    border-radius:24px;
    border:1.5px solid #e8e7e0;
    padding:30px;
    height:100%;
    transition:.25s;
    text-decoration:none;
    display:block;
}

.service-card:hover{
    transform:translateY(-6px);
    box-shadow:0 12px 32px rgba(0,0,0,.08);
    border-color:#d0cfff;
}

.service-icon{
    width:72px;
    height:72px;
    border-radius:20px;
    background:#f0f0ff;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:22px;
    font-size:30px;
    color:#4a4aff;
}

.service-card h4{
    font-family:'Sora',sans-serif;
    font-size:20px;
    color:#1a1a2e;
    margin-bottom:12px;
}

.service-card p{
    color:#777;
    line-height:1.7;
    font-size:14px;
}

.about-box{
    background:#fff;
    border-radius:24px;
    border:1.5px solid #e8e7e0;
    padding:40px;
    line-height:1.9;
    color:#666;
}

</style>

<div class="hero">

    <h1>
        Reserva de Espaços Públicos
    </h1>

    <p>
        Plataforma moderna para reservas de quadras,
        campos, salões e áreas públicas da prefeitura.
    </p>

    <a href="{{ route('cidades.index') }}"
        class="hero-btn">
        Explorar Espaços
    </a>

</div>

<div class="container">

    <section class="section">

        <h2 class="section-title">
            Serviços Disponíveis
        </h2>

        <div class="row g-4">

            <div class="col-md-3">
                <a href="#" class="service-card">

                    <div class="service-icon">
                        ⚽
                    </div>

                    <h4>Campos</h4>

                    <p>
                        Reserve campos municipais para jogos e eventos esportivos.
                    </p>

                </a>
            </div>

            <div class="col-md-3">
                <a href="#" class="service-card">

                    <div class="service-icon">
                        🏀
                    </div>

                    <h4>Quadras</h4>

                    <p>
                        Espaços esportivos para futsal, vôlei e basquete.
                    </p>

                </a>
            </div>

            <div class="col-md-3">
                <a href="#" class="service-card">

                    <div class="service-icon">
                        🎉
                    </div>

                    <h4>Eventos</h4>

                    <p>
                        Salões comunitários para festas e encontros.
                    </p>

                </a>
            </div>

            <div class="col-md-3">
                <a href="#" class="service-card">

                    <div class="service-icon">
                        🌳
                    </div>

                    <h4>Lazer</h4>

                    <p>
                        Áreas públicas para convivência e recreação.
                    </p>

                </a>
            </div>

        </div>

    </section>

    <section class="section">

        <div class="about-box">

            <h2 class="section-title mb-4">
                Sobre o Sistema
            </h2>

            <p>
                Este sistema foi desenvolvido para modernizar
                a gestão de espaços públicos da prefeitura,
                permitindo reservas rápidas, organizadas e acessíveis.
            </p>

        </div>

    </section>

</div>

@endsection
