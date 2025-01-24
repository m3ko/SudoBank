<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rescatados extends Model
{
    protected $fillable = [

        'nombre',
        'apellido',
        'foto',
        'edad',
        'sexo',
        'procedencia',
        'valoracion_medica',
        'medico_id',
        'rescate_id'


    ];
    public function rescates(): BelongsTo
    {
        return $this->belongsTo(Rescates::class);
    }
}
