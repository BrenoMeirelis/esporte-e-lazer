<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConviteAdministradorCidade extends Model
{
    use HasFactory;

    protected $table = 'convite_administrador_cidades';

    protected $fillable = [
        'cidade_id',
        'convidado_por',
        'email',
        'token',
        'status',
        'respondido_em',
    ];

    protected $casts = [
        'respondido_em' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTOS
    |--------------------------------------------------------------------------
    */

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    public function convidante()
    {
        return $this->belongsTo(User::class, 'convidado_por');
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    public function foiAceito(): bool
    {
        return $this->status === 'aceito';
    }

    public function foiRejeitado(): bool
    {
        return $this->status === 'rejeitado';
    }

    public function estaPendente(): bool
    {
        return $this->status === 'pendente';
    }

    /*
    |--------------------------------------------------------------------------
    | AÇÕES
    |--------------------------------------------------------------------------
    */

    public function aceitar(): void
    {
        $this->update([
            'status' => 'aceito',
            'respondido_em' => now(),
        ]);
    }

    public function rejeitar(): void
    {
        $this->update([
            'status' => 'rejeitado',
            'respondido_em' => now(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopePendentes($query)
    {
        return $query->where('status', 'pendente');
    }

    public function scopeAceitos($query)
    {
        return $query->where('status', 'aceito');
    }

    public function scopeRejeitados($query)
    {
        return $query->where('status', 'rejeitado');
    }
}
