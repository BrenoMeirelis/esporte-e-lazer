@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    body { font-family: 'DM Sans', sans-serif; background: #f5f4f0; }

    /* HERO */
    .reserva-hero {
        padding: 36px 0 72px;
        position: relative;
        overflow: hidden;
    }
    .reserva-hero.status-pendente  { background: #1a1a2e; }
    .reserva-hero.status-aprovada  { background: #052e16; }
    .reserva-hero.status-recusada  { background: #450a0a; }
    .reserva-hero::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0; right: 0;
        height: 48px;
        background: #f5f4f0;
        border-radius: 48px 48px 0 0;
    }
    .breadcrumb-nav {
        font-size: 13px;
        color: rgba(255,255,255,0.4);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .breadcrumb-nav a { color: rgba(255,255,255,0.5); text-decoration: none; }
    .breadcrumb-nav a:hover { color: #fff; }

    .reserva-hero .status-big {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 18px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 16px;
    }
    .status-big.pendente { background: rgba(245,158,11,0.2); color: #fcd34d; border: 1px solid rgba(245,158,11,0.3); }
    .status-big.aprovada { background: rgba(34,197,94,0.2); color: #86efac; border: 1px solid rgba(34,197,94,0.3); }
    .status-big.recusada { background: rgba(239,68,68,0.2); color: #fca5a5; border: 1px solid rgba(239,68,68,0.3); }

    .reserva-hero h1 {
        font-family: 'Sora', sans-serif;
        font-size: 30px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 6px;
    }
    .reserva-hero .sub { color: rgba(255,255,255,0.5); font-size: 14px; }

    /* LAYOUT */
    .reserva-layout {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 24px;
        padding: 24px 0 60px;
        align-items: start;
    }

    .card-section {
        background: #fff;
        border-radius: 18px;
        border: 1.5px solid #e8e7e0;
        padding: 24px 26px;
        margin-bottom: 18px;
    }
    .card-section h3 {
        font-family: 'Sora', sans-serif;
        font-size: 15px;
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .card-section h3 i { color: #4a4aff; }

    /* DETALHES DA RESERVA */
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    .detail-item {
        background: #fafaf8;
        border-radius: 10px;
        padding: 12px 14px;
        border: 1px solid #f0efe8;
    }
    .detail-item .label {
        font-size: 11px;
        color: #aaa;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 4px;
    }
    .detail-item .value {
        font-size: 15px;
        font-weight: 500;
        color: #1a1a2e;
    }

    /* TIMELINE */
    .timeline {
        position: relative;
        padding-left: 24px;
    }
    .timeline::before {
        content: '';
        position: absolute;
        left: 8px;
        top: 8px;
        bottom: 8px;
        width: 2px;
        background: #e8e7e0;
    }
    .timeline-item {
        position: relative;
        padding-bottom: 20px;
    }
    .timeline-item:last-child { padding-bottom: 0; }
    .timeline-dot {
        position: absolute;
        left: -20px;
        top: 2px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        border: 2px solid #e8e7e0;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .timeline-dot.done { border-color: #22c55e; background: #22c55e; }
    .timeline-dot.done::after { content: ''; width: 5px; height: 5px; background: #fff; border-radius: 50%; }
    .timeline-dot.active { border-color: #4a4aff; background: #4a4aff; }
    .timeline-dot.active::after { content: ''; width: 5px; height: 5px; background: #fff; border-radius: 50%; }
    .timeline-item .tl-title { font-size: 14px; font-weight: 500; color: #1a1a2e; }
    .timeline-item .tl-sub { font-size: 12px; color: #aaa; margin-top: 2px; }

    /* AÇÕES */
    .btn-cancelar {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 20px;
        border-radius: 10px;
        border: 1.5px solid #e0dfd8;
        background: #fff;
        color: #888;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }
    .btn-cancelar:hover { border-color: #ef4444; color: #ef4444; background: #fee2e2; }

    /* CHAT */
    .chat-wrap {
        background: #fff;
        border-radius: 18px;
        border: 1.5px solid #e8e7e0;
        overflow: hidden;
        position: sticky;
        top: 20px;
        display: flex;
        flex-direction: column;
        max-height: 620px;
    }
    .chat-header {
        padding: 18px 20px;
        border-bottom: 1px solid #f0efe8;
        background: #fafaf8;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .chat-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #ededff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }
    .chat-header-info .name {
        font-family: 'Sora', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #1a1a2e;
    }
    .chat-header-info .role {
        font-size: 12px;
        color: #aaa;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .online-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #22c55e;
        display: inline-block;
    }

    .chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        min-height: 280px;
    }

    .msg {
        max-width: 82%;
        padding: 10px 14px;
        border-radius: 16px;
        font-size: 14px;
        line-height: 1.5;
    }
    .msg.received {
        align-self: flex-start;
        background: #f0f0f5;
        color: #333;
        border-bottom-left-radius: 4px;
    }
    .msg.sent {
        align-self: flex-end;
        background: #4a4aff;
        color: #fff;
        border-bottom-right-radius: 4px;
    }
    .msg-time {
        font-size: 10px;
        opacity: 0.55;
        margin-top: 4px;
        text-align: right;
    }
    .msg.received .msg-time { text-align: left; }

    .chat-locked {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 32px;
        text-align: center;
        color: #bbb;
        min-height: 200px;
    }
    .chat-locked .lock-icon { font-size: 36px; margin-bottom: 12px; }
    .chat-locked p { font-size: 13px; line-height: 1.5; }

    .chat-input-bar {
        padding: 14px 16px;
        border-top: 1px solid #f0efe8;
        display: flex;
        gap: 8px;
        background: #fafaf8;
    }
    .chat-input-bar input {
        flex: 1;
        padding: 10px 16px;
        border: 1.5px solid #e0dfd8;
        border-radius: 30px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s;
        background: #fff;
    }
    .chat-input-bar input:focus { border-color: #4a4aff; }
    .chat-input-bar input:disabled { background: #f5f5f5; color: #ccc; cursor: not-allowed; }
    .btn-send {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #4a4aff;
        border: none;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
        flex-shrink: 0;
    }
    .btn-send:hover { background: #1a1a2e; }
    .btn-send:disabled { background: #e0dfd8; cursor: not-allowed; }

    .motivo-recusa {
        background: #fee2e2;
        border: 1px solid #fca5a5;
        border-radius: 10px;
        padding: 14px 16px;
        font-size: 14px;
        color: #7f1d1d;
        line-height: 1.6;
    }

    @media(max-width: 900px) {
        .reserva-layout { grid-template-columns: 1fr; }
        .chat-wrap { position: static; max-height: none; }
        .detail-grid { grid-template-columns: 1fr; }
    }
</style>

@php
    $status = $reserva->status ?? 'pendente';
    $aprovada = $status === 'aprovada';
    $data = \Carbon\Carbon::parse($reserva->data);
@endphp

<div class="reserva-hero status-{{ $status }}">
    <div class="container">
        <div class="breadcrumb-nav">
            <a href="{{ route('reservas.index') }}">Minhas Reservas</a>
            <i class="bi bi-chevron-right" style="font-size:11px;"></i>
            <span>#{{ $reserva->id }}</span>
        </div>
        <div class="status-big {{ $status }}">
            @if($status === 'pendente')
                <i class="bi bi-hourglass-split"></i> Aguardando aprovação
            @elseif($status === 'aprovada')
                <i class="bi bi-check-circle-fill"></i> Reserva aprovada
            @elseif($status === 'recusada')
                <i class="bi bi-x-circle-fill"></i> Reserva recusada
            @endif
        </div>
        <h1>{{ $reserva->espaco->titulo ?? 'Espaço' }}</h1>
        <p class="sub">{{ $data->format('d/m/Y') }} · {{ \Carbon\Carbon::parse($reserva->hora_inicio)->format('H:i') }} — {{ \Carbon\Carbon::parse($reserva->hora_fim)->format('H:i') }}</p>
    </div>
</div>

<div class="container">
    <div class="reserva-layout">

        <!-- COLUNA ESQUERDA -->
        <div>
            <!-- DETALHES DA RESERVA -->
            <div class="card-section">
                <h3><i class="bi bi-calendar-check"></i> Detalhes da reserva</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <div class="label">Espaço</div>
                        <div class="value">{{ $reserva->espaco->titulo ?? '-' }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="label">Cidade</div>
                        <div class="value">{{ $reserva->espaco->cidade->nome ?? '-' }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="label">Data</div>
                        <div class="value">{{ $data->format('d/m/Y') }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="label">Horário</div>
                        <div class="value">{{ \Carbon\Carbon::parse($reserva->hora_inicio)->format('H:i') }} — {{ \Carbon\Carbon::parse($reserva->hora_fim)->format('H:i') }}</div>
                    </div>
                    @if($reserva->espaco && $reserva->espaco->localizacao)
                    <div class="detail-item" style="grid-column: 1/-1;">
                        <div class="label">Localização</div>
                        <div class="value">{{ $reserva->espaco->localizacao }}</div>
                    </div>
                    @endif
                    @if($reserva->espaco && $reserva->espaco->responsavel)
                    <div class="detail-item" style="grid-column: 1/-1;">
                        <div class="label">Responsável pelo espaço</div>
                        <div class="value">{{ $reserva->espaco->responsavel }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- MOTIVO DA RECUSA -->
            @if($status === 'recusada' && isset($reserva->motivo_recusa))
            <div class="card-section">
                <h3><i class="bi bi-x-circle" style="color:#ef4444;"></i> Motivo da recusa</h3>
                <div class="motivo-recusa">
                    <i class="bi bi-quote"></i> {{ $reserva->motivo_recusa }}
                </div>
                <a href="{{ route('cidades.index') }}" style="display:inline-flex;align-items:center;gap:6px;margin-top:16px;padding:10px 20px;background:#1a1a2e;color:#fff;border-radius:10px;font-size:14px;text-decoration:none;transition:background 0.2s;" onmouseover="this.style.background='#4a4aff'" onmouseout="this.style.background='#1a1a2e'">
                    <i class="bi bi-arrow-left"></i> Fazer nova reserva
                </a>
            </div>
            @endif

            <!-- TIMELINE -->
            <div class="card-section">
                <h3><i class="bi bi-clock-history"></i> Progresso da reserva</h3>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-dot done"></div>
                        <div class="tl-title">Reserva enviada</div>
                        <div class="tl-sub">Sua solicitação foi registrada com sucesso.</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot {{ $status !== 'pendente' ? 'done' : 'active' }}"></div>
                        <div class="tl-title">Análise do administrador</div>
                        <div class="tl-sub">
                            @if($status === 'pendente') Em análise — aguarde a aprovação.
                            @elseif($status === 'aprovada') Aprovada pelo administrador.
                            @else Recusada pelo administrador.
                            @endif
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot {{ $aprovada ? 'done' : '' }}"></div>
                        <div class="tl-title">Contato com o responsável</div>
                        <div class="tl-sub">{{ $aprovada ? 'Disponível — use o chat ao lado.' : 'Disponível após aprovação.' }}</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot {{ $aprovada ? 'active' : '' }}"></div>
                        <div class="tl-title">Uso do espaço</div>
                        <div class="tl-sub">{{ $aprovada ? 'Compareça no horário agendado.' : 'Disponível após aprovação.' }}</div>
                    </div>
                </div>
            </div>

            <!-- AÇÕES -->
            @if($status === 'pendente')
            <div class="card-section" style="padding:18px 26px;">
                <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
                    <p style="font-size:13px;color:#888;margin:0;">Deseja cancelar esta reserva?</p>
                    <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST"
                        onsubmit="return confirm('Tem certeza que deseja cancelar esta reserva?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-cancelar">
                            <i class="bi bi-trash3"></i> Cancelar reserva
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>

        <!-- COLUNA DIREITA: CHAT -->
        <div>
            <div class="chat-wrap">
                <div class="chat-header">
                    <div class="chat-avatar">🏟️</div>
                    <div class="chat-header-info">
                        <div class="name">{{ $reserva->espaco->responsavel ?? 'Responsável pelo espaço' }}</div>
                        <div class="role">
                            @if($aprovada)
                                <span class="online-dot"></span> Disponível para contato
                            @else
                                <i class="bi bi-lock"></i> Bloqueado até aprovação
                            @endif
                        </div>
                    </div>
                </div>

                @if($aprovada)
                <div class="chat-messages" id="chat-messages">
                    <!-- Mensagem de boas vindas automática -->
                    <div class="msg received">
                        Olá! Sua reserva foi aprovada. 🎉<br>
                        Como posso ajudar? Você pode me perguntar sobre as chaves de acesso, materiais disponíveis ou qualquer dúvida sobre o espaço.
                        <div class="msg-time">Sistema</div>
                    </div>

                    @if(isset($mensagens) && $mensagens->count() > 0)
                    @foreach($mensagens as $msg)
                    @php $isMine = $msg->user_id === auth()->id(); @endphp
                    <div class="msg {{ $isMine ? 'sent' : 'received' }}">
                        {{ $msg->mensagem }}
                        <div class="msg-time">{{ \Carbon\Carbon::parse($msg->created_at)->format('H:i') }}</div>
                    </div>
                    @endforeach
                    @endif
                </div>

                <div class="chat-input-bar">
                    <input type="text" id="chat-input" placeholder="Digite uma mensagem..." maxlength="500">
                    <button class="btn-send" id="btn-send" onclick="enviarMensagem()">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </div>

                @else
                <!-- CHAT BLOQUEADO -->
                <div class="chat-locked">
                    <div class="lock-icon"><i class="bi bi-lock-fill"></i></div>
                    @if($status === 'pendente')
                    <p>O chat com o responsável será liberado após a <strong>aprovação da sua reserva</strong>.</p>
                    @else
                    <p>O chat não está disponível para reservas recusadas.</p>
                    @endif
                </div>
                <div class="chat-input-bar">
                    <input type="text" disabled placeholder="Chat disponível após aprovação...">
                    <button class="btn-send" disabled><i class="bi bi-send-fill"></i></button>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>

@if($aprovada)
<script>
    const reservaId = {{ $reserva->id }};
    const chatMessages = document.getElementById('chat-messages');

    // Scroll para o final
    chatMessages.scrollTop = chatMessages.scrollHeight;

    function enviarMensagem() {
        const input = document.getElementById('chat-input');
        const msg = input.value.trim();
        if (!msg) return;

        // Exibe imediatamente (otimista)
        const div = document.createElement('div');
        div.className = 'msg sent';
        const agora = new Date();
        const hora = agora.getHours().toString().padStart(2,'0') + ':' + agora.getMinutes().toString().padStart(2,'0');
        div.innerHTML = msg + '<div class="msg-time">' + hora + '</div>';
        chatMessages.appendChild(div);
        chatMessages.scrollTop = chatMessages.scrollHeight;
        input.value = '';

        // Envia ao servidor
        fetch('/reservas/' + reservaId + '/mensagens', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ mensagem: msg })
        }).catch(() => {
            // Se falhar, mantém a mensagem (pode recarregar para sincronizar)
        });
    }

    // Enter para enviar
    document.getElementById('chat-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') enviarMensagem();
    });

    // Polling de novas mensagens a cada 10 segundos
    setInterval(function() {
        fetch('/reservas/' + reservaId + '/mensagens')
            .then(r => r.json())
            .then(data => {
                // Implementar refresh incremental se necessário
            }).catch(() => {});
    }, 10000);
</script>
@endif
@endsection
