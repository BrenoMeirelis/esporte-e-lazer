<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espaco extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'cidade_id',
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
    ];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }
}
