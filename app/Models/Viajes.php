<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viajes extends Model
{
    protected $fillable = [
        'origen',
        'destino',
        'rol',
        'fechaHora'
    ];
    public function tripulantes(): BelongsToMany{
        return $this->belongsToMany(tripulantes::class);
    }
}
