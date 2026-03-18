<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cidade; // Corrigido o namespace

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

    // Relacionamento com Cidade
    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }
}
