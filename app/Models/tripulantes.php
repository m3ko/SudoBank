<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tripulantes extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'rol',
        'fecha_incorporacion',
        'fecha_baja'
    ];

    public function viajes(): BelongsToMany{
        return $this->belongsToMany(viajes::class);
    }
}
