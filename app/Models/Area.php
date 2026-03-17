<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

    protected $fillable = [
        'nome',
        'cidade_id'
    ];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

}
