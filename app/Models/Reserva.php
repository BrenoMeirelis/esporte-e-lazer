<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{

    protected $fillable = [
        'user_id',
        'espaco_id',
        'data',
        'hora_inicio',
        'hora_fim'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function espaco()
    {
        return $this->belongsTo(Espaco::class);
    }

}
