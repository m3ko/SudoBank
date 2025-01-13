<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class viajes extends Model
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
