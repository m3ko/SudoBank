<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
