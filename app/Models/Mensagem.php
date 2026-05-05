<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mensagem extends Model
{
    use HasFactory;

    protected $fillable = [
        'reserva_id',
        'user_id',
        'mensagem',
    ];

    // ─── RELACIONAMENTOS ─────────────────────────────────────────────────────

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
