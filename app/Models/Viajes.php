<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Viajes extends Model
{
    protected $fillable = [
        'origen',
        'destino',
        'fechaHora'
    ];
    public function tripulantes(): BelongsToMany{
        return $this->belongsToMany(Tripulantes::class, 'tripulantes_viaje');
    }
    public function medicos(): BelongsToMany{
        return $this->belongsToMany(Medicos::class, 'medicos_viaje');
    }
    public function rescates(): HasMany
    {
        return $this->hasMany(Rescates::class);
    }
}
