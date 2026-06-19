<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'espaco_id',
        'user_id',
        'data',
        'hora_inicio',
        'hora_fim',
        'numero_participantes',
        'participantes',
        'status',
        'motivo_recusa'
    ];

    protected $casts = [
        'data' => 'date',
        'participantes' => 'array',
    ];

    // ─── CONSTANTES DE STATUS ────────────────────────────────────────────────

    const STATUS_PENDENTE = 'pendente';
    const STATUS_APROVADA = 'aprovada';
    const STATUS_RECUSADA = 'recusada';

    // ─── RELACIONAMENTOS ─────────────────────────────────────────────────────

    public function espaco()
    {
        return $this->belongsTo(Espaco::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mensagens()
    {
        return $this->hasMany(Mensagem::class)->orderBy('created_at', 'asc');
    }

    // ─── HELPERS ─────────────────────────────────────────────────────────────

    public function isPendente(): bool
    {
        return $this->status === self::STATUS_PENDENTE;
    }

    public function isAprovada(): bool
    {
        return $this->status === self::STATUS_APROVADA;
    }

    public function isRecusada(): bool
    {
        return $this->status === self::STATUS_RECUSADA;
    }
}
