<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa el trait correcto



class CuentaBancaria extends Model
{
    use HasFactory;


    protected $table = 'cuentas_bancarias'; // Nombre correcto de la tabla

    protected $fillable = ['user_id', 'saldo', 'num_cuenta', 'tipo_moneda'];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function tarjetas()
    {
        return $this->hasMany(Tarjeta::class);
    }
}
