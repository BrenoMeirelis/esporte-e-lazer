<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function espacos()
    {
        return $this->hasMany(Espaco::class);
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }
}
