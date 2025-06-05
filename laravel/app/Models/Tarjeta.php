<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa el trait correcto
use App\Models\CuentaBancaria;


class Tarjeta extends Model
{
    use HasFactory;

    protected $fillable = ['cuenta_bancaria_id', 'tipo_tarjeta', 'fecha_expiracion'];

    public function cuentaBancaria()
    {
        return $this->belongsTo(CuentaBancaria::class, 'cuenta_bancaria_id');
    }
}
