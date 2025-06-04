<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CuentaBancaria;

class Deuda extends Model
{
    use HasFactory;

    protected $fillable = [
        'cuenta_id',
        'num_cuenta_destino',
        'concepto',
        'monto',
        'fecha_generacion',
    ];

    public function cuenta()
    {
        return $this->belongsTo(CuentaBancaria::class, 'cuenta_id');
    }
}