<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PagoPendiente;
use App\Models\Deuda;

class MoverPagosPendientesAVencidos extends Command
{
    protected $signature = 'pagos:mover-vencidos'; // Nombre del comando
    protected $description = 'Mover pagos pendientes vencidos a la tabla de deudas con un 20% adicional';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $pagosPendientes = PagoPendiente::where('fecha_vencimiento', '<', now())->get();

        foreach ($pagosPendientes as $pagoPendiente) {
            // Calcular el nuevo monto con el 20% adicional
            $nuevoMonto = $pagoPendiente->monto * 1.2;

            // Crear una nueva deuda
            Deuda::create([
                'cuenta_id' => $pagoPendiente->cuenta_id,
                'num_cuenta_destino' => $pagoPendiente->num_cuenta_destino,
                'concepto' => $pagoPendiente->concepto . ' (Vencido)',
                'monto' => $nuevoMonto,
                'fecha_generacion' => now(),
            ]);

            // Eliminar el pago pendiente
            $pagoPendiente->delete();
        }

        $this->info('Pagos pendientes vencidos movidos a deudas correctamente.');
    }
}
