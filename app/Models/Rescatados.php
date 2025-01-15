<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rescatados extends Model
{
    protected $fillable = [

        'nombre',
        'apellido',
        'foto',
        'edad',
        'sexo',
        'procedencia',
        'valoración_medica',
        'medico_id',
        'rescate_id'


    ];
    public function rescates(): BelongsTo
    {
        return $this->belongsTo(Rescates::class);
    }
}
