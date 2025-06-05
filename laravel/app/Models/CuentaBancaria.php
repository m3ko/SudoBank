<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa el trait correcto
use App\Models\User;
use App\Models\Tarjeta;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class CuentaBancaria extends Model
{
    use HasFactory;


    protected $table = 'cuentas_bancarias'; // Nombre correcto de la tabla

    protected $fillable = ['user_id', 'saldo', 'num_cuenta', 'tipo_moneda', 'cvv', 'fecha_expiracion'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tarjetas()
    {
        return $this->hasMany(Tarjeta::class, 'cuenta_bancaria_id');
    }
}
