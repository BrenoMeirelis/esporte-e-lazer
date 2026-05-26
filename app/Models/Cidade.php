<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Espaco;
use App\Models\Area;
use App\Models\Categoria;

class Cidade extends Model
{
    protected $fillable = [
        'nome',
        'cep',
        'uf',
        'email',
    ];

    public function espacos()
    {
        return $this->hasMany(Espaco::class);
    }

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }

    public function administradores()
    {
        return $this->belongsToMany(User::class, 'cidade_user')
            ->withTimestamps();
    }
}
