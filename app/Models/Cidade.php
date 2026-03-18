<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Espaco;
use App\Models\Area;

class Cidade extends Model
{
    protected $fillable = [
        'nome',
        'cep',
        'uf',
        'email'
    ];

    // Relacionamento com Espaços
    public function espacos()
    {
        return $this->hasMany(Espaco::class);
    }

    // Relacionamento com Usuários autorizados
    public function usuarios()
    {
        return $this->belongsToMany(User::class);
    }

    // Relacionamento com Áreas
    public function areas()
    {
        return $this->hasMany(Area::class);
    }
}
