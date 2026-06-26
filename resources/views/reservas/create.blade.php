@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: #f5f4f0;
        }

        .page-header {
            background: #1a1a2e;
            color: #fff;
            padding: 40px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .page-header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 48px;
            background: #f5f4f0;
            border-radius: 48px 48px 0 0;
        }

        .page-header h1 {
            font-family: 'Sora', sans-serif;
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #9090c0;
            margin: 0;
        }

        .reserve-card {
            background: #fff;
            border-radius: 24px;
            border: 1.5px solid #e8e7e0;
            padding: 30px;
            box-shadow: 0 14px 36px rgba(0, 0, 0, 0.08);
            margin-top: 30px;
        }

        .space-box {
            background: #f7f7fb;
            border: 1.5px solid #ececff;
            border-radius: 18px;
            padding: 20px;
            margin-bottom: 28px;
        }

        .space-box h3 {
            font-family: 'Sora', sans-serif;
            font-size: 22px;
            color: #1a1a2e;
            margin-bottom: 8px;
        }

        .space-box p {
            color: #777;
            margin: 0;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #666;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 14px;
            border: 1.5px solid #e5e5e5;
            padding: 13px 16px;
            font-size: 14px;
            transition: .2s;
        }

        .form-control:focus {
            border-color: #4a4aff;
            box-shadow: none;
        }

        /* Campo com erro destacado */
        .form-control.is-invalid {
            border-color: #dc3545;
            background-image: none;
        }

        .btn-main {
            background: #1a1a2e;
            color: #fff;
            border: none;
            padding: 14px 32px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 600;
            transition: .2s;
        }

        .btn-main:hover {
            background: #4a4aff;
        }

        .btn-soft {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 14px;
            border: 1.5px solid #e5e5e5;
            background: #fff;
            color: #555;
            text-decoration: none;
            transition: .2s;
        }

        .btn-soft:hover {
            border-color: #4a4aff;
            color: #4a4aff;
            background: #f0f0ff;
        }

        .alert-modern {
            border: none;
            border-radius: 16px;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .input-icon .form-control {
            padding-left: 42px;
        }
    </style>

    <div class="page-header">
        <div class="container">
            <h1>Reservar Espaço</h1>
            <p>Escolha a data e horário da reserva</p>
        </div>
    </div>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-7">

                <div class="reserve-card">

                    @if (session('error'))
                        <div class="alert alert-danger alert-modern mb-4">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-modern mb-4">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            <strong>Por favor, corrija os erros abaixo:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="space-box">
                        <h3>📍 {{ $espaco->titulo }}</h3>
                        <p>Faça sua reserva de forma rápida e organizada.</p>
                    </div>

                    <form method="POST" action="{{ route('reservas.store') }}">
                        @csrf

                        <input type="hidden" name="espaco_id" value="{{ $espaco->id }}">

                        {{-- Data --}}
                        <div class="mb-4">
                            <label class="form-label">Data da Reserva</label>
                            <div class="input-icon">
                                <i class="bi bi-calendar-event"></i>
                                <input
                                    type="date"
                                    name="data"
                                    class="form-control @error('data') is-invalid @enderror"
                                    value="{{ old('data', request('data')) }}"
                                    required>
                            </div>
                            @error('data')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Horários --}}
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Hora Início</label>
                                <div class="input-icon">
                                    <i class="bi bi-clock"></i>
                                    <input
                                        type="time"
                                        name="hora_inicio"
                                        class="form-control @error('hora_inicio') is-invalid @enderror"
                                        value="{{ old('hora_inicio') }}"
                                        required>
                                </div>
                                @error('hora_inicio')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Hora Fim</label>
                                <div class="input-icon">
                                    <i class="bi bi-clock-history"></i>
                                    <input
                                        type="time"
                                        name="hora_fim"
                                        class="form-control @error('hora_fim') is-invalid @enderror"
                                        value="{{ old('hora_fim') }}"
                                        required>
                                </div>
                                @error('hora_fim')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Número de participantes --}}
                        <div class="my-4">
                            <label class="form-label">Número de Participantes</label>
                            <input
                                type="number"
                                name="numero_participantes"
                                id="numero_participantes"
                                class="form-control @error('numero_participantes') is-invalid @enderror"
                                min="{{ $espaco->min_participantes ?? 1 }}"
                                max="{{ $espaco->max_participantes ?? 999 }}"
                                value="{{ old('numero_participantes', $espaco->min_participantes ?? 1) }}"
                                required>
                            <small style="color:#888;">
                                Permitido: mínimo {{ $espaco->min_participantes ?? 1 }} e máximo
                                {{ $espaco->max_participantes ?? 'sem limite' }} participantes.
                            </small>
                            @error('numero_participantes')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror

                            <div id="participantes-area"></div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ url()->previous() }}" class="btn-soft">
                                <i class="bi bi-arrow-left"></i>
                                Voltar
                            </a>
                            <button type="submit" class="btn-main">
                                Confirmar Reserva
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    {{-- Dados de participantes vindos do old() para restaurar após erro --}}
    <script>
        const oldParticipantes = @json(old('participantes', []));
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const horaInicio = document.querySelector('input[name="hora_inicio"]');
            const horaFim    = document.querySelector('input[name="hora_fim"]');

            const horaAbertura    = "{{ $espaco->horario_abertura }}";
            const horaEncerramento = "{{ $espaco->horario_encerramento }}";

            const minParticipantes = {{ $espaco->min_participantes ?? 1 }};
            const maxParticipantes = {{ $espaco->max_participantes ?? 999 }};

            const numeroParticipantes = document.getElementById('numero_participantes');
            const participantesArea   = document.getElementById('participantes-area');

            // ------------------------------------------------------------------
            // Validação de horário no front-end
            // ------------------------------------------------------------------
            function validarHorario() {

                horaInicio.setCustomValidity('');
                horaFim.setCustomValidity('');

                if (!horaInicio.value || !horaFim.value) return;

                if (horaInicio.value < horaAbertura) {
                    horaInicio.setCustomValidity(
                        `O espaço funciona somente a partir das ${horaAbertura}.`
                    );
                    horaInicio.reportValidity();
                    return;
                }

                if (horaFim.value > horaEncerramento) {
                    horaFim.setCustomValidity(
                        `O espaço funciona somente até ${horaEncerramento}.`
                    );
                    horaFim.reportValidity();
                    return;
                }

                if (horaFim.value <= horaInicio.value) {
                    horaFim.setCustomValidity(
                        'A hora final deve ser maior que a hora inicial.'
                    );
                    horaFim.reportValidity();
                    return;
                }
            }

            horaInicio.addEventListener('input', validarHorario);
            horaFim.addEventListener('input', validarHorario);

            // ------------------------------------------------------------------
            // Gera campos de participantes preservando dados já digitados
            // e restaurando valores do old() em caso de erro
            // ------------------------------------------------------------------
            function gerarParticipantes() {

                let total = parseInt(numeroParticipantes.value || 0);

                if (total < minParticipantes) {
                    numeroParticipantes.setCustomValidity(
                        'O mínimo permitido é ' + minParticipantes + ' participantes.'
                    );
                    return;
                }

                if (total > maxParticipantes) {
                    numeroParticipantes.setCustomValidity(
                        'O máximo permitido é ' + maxParticipantes + ' participantes.'
                    );
                    return;
                }

                numeroParticipantes.setCustomValidity('');

                // Salva valores dos campos que já existem na tela
                const valoresExistentes = {};
                participantesArea.querySelectorAll('[name^="participantes["]').forEach(input => {
                    valoresExistentes[input.name] = input.value;
                });

                participantesArea.innerHTML = '';

                for (let i = 1; i <= total; i++) {

                    // Prioridade: campo já digitado > old() do Laravel > vazio
                    const nomeKey      = `participantes[${i - 1}][nome]`;
                    const documentoKey = `participantes[${i - 1}][documento]`;

                    const nomeVal      = valoresExistentes[nomeKey]
                                         ?? (oldParticipantes[i - 1]?.nome ?? '');
                    const documentoVal = valoresExistentes[documentoKey]
                                         ?? (oldParticipantes[i - 1]?.documento ?? '');

                    participantesArea.innerHTML += `
                        <div class="mb-3 p-3" style="border:1.5px solid #e8e7e0;border-radius:16px;background:#fafaf8;">
                            <strong style="display:block;margin-bottom:12px;color:#1a1a2e;">
                                Participante ${i}
                            </strong>

                            <div class="mb-3">
                                <label class="form-label">Nome</label>
                                <input
                                    type="text"
                                    name="${nomeKey}"
                                    class="form-control"
                                    maxlength="255"
                                    value="${escapeHtml(nomeVal)}"
                                    required>
                            </div>

                            <div>
                                <label class="form-label">Documento</label>
                                <input
                                    type="text"
                                    name="${documentoKey}"
                                    class="form-control documento-participante"
                                    maxlength="14"
                                    placeholder="CPF"
                                    value="${escapeHtml(documentoVal)}"
                                    required>
                            </div>
                        </div>
                    `;
                }

                aplicarMascaraDocumentos();
            }

            // Escapa caracteres especiais para evitar XSS ao inserir via innerHTML
            function escapeHtml(str) {
                return String(str)
                    .replace(/&/g, '&amp;')
                    .replace(/"/g, '&quot;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;');
            }

            // ------------------------------------------------------------------
            // Máscara de CPF
            // ------------------------------------------------------------------
            function aplicarMascaraDocumentos() {

                document.querySelectorAll('.documento-participante').forEach(input => {

                    input.addEventListener('input', function () {

                        let value = this.value.replace(/\D/g, '').slice(0, 11);

                        value = value.replace(/(\d{3})(\d)/, '$1.$2');
                        value = value.replace(/(\d{3})(\d)/, '$1.$2');
                        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

                        this.value = value;
                    });

                });
            }

            numeroParticipantes.addEventListener('input', gerarParticipantes);

            // Gera campos ao carregar a página (restaurando old() se houver)
            gerarParticipantes();

        });
    </script>
@endsection
