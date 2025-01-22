<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Medicos extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'fecha_incorporacion',
        'fecha_baja'
    ];
    public function viajes(): BelongsToMany{
        return $this->belongsToMany(Viajes::class, 'medicos_viaje');
    }
}
