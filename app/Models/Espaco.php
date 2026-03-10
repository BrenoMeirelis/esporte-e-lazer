<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Espaco extends Model
{
    protected $fillable = [
        'cidade_id',
        'titulo',
        'descricao',
        'horario_abertura',
        'horario_encerramento',
        'periodo_max_reserva',
        'localizacao',
        'regras',
        'observacoes',
        'min_participantes',
        'max_participantes',
        'materiais',
        'responsavel',
        'foto'
    ];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }
}
