<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa el trait correcto
use App\Models\User;
use App\Models\CuentaBancaria;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bizum extends Model
{
    use HasFactory;

    protected $fillable = ['id_emisor', 'id_receptor', 'cuenta_emisor', 'cuenta_receptor', 'monto', 'fecha_hora'];

    public function emisor()
    {
        return $this->belongsTo(User::class, 'id_emisor');
    }

    public function receptor()
    {
        return $this->belongsTo(User::class, 'id_receptor');
    }
}
