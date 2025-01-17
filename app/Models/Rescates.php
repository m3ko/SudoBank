<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rescates extends Model
{
    protected $fillable = [

        'fechaHora_inicio',
        'fechaHora_fin',
        'viajes_id'

    ];
    public function rescatados(): HasMany
    {
        return $this->hasMany(Rescatados::class);
    }
}
