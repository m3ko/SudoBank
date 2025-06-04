<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CuentaBancaria;

class PagoPendiente extends Model
{
    use HasFactory;
    protected $table = 'pagos_pendientes'; // Nombre correcto de la tabla
    protected $fillable = [
        'cuenta_id',
        'num_cuenta_destino',
        'concepto',
        'monto',
        'fecha_vencimiento',
    ];

    public function cuenta()
    {
        return $this->belongsTo(CuentaBancaria::class, 'cuenta_id');
    }
}