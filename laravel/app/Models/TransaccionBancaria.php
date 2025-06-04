<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CuentaBancaria;

class TransaccionBancaria extends Model
{
    use HasFactory;

    protected $table = 'transacciones_bancarias'; // Nombre correcto de la tabla

    protected $fillable = [
        'cuenta_id',
        'num_cuenta_destino',
        'concepto',
        'monto',
        'fecha',
    ];

    public function cuenta()
    {
        return $this->belongsTo(CuentaBancaria::class, 'cuenta_id');
    }
}