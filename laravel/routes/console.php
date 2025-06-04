<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\PagoPendiente;
use App\Models\Deuda;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('pagos:mover-vencidos', function () {
    $this->info('Comando iniciado.');
    $this->info('Fecha actual: ' . now());
    $this->info('Buscando pagos pendientes vencidos...');

    $pagosPendientes = PagoPendiente::where('fecha_vencimiento', '<', now())->get();

    if ($pagosPendientes->isEmpty()) {
        $this->info('No hay pagos pendientes vencidos.');
        return;
    }

    foreach ($pagosPendientes as $pagoPendiente) {
        $this->info('Procesando pago pendiente ID: ' . $pagoPendiente->id);

        $nuevoMonto = $pagoPendiente->monto * 1.2;

        Deuda::create([
            'cuenta_id' => $pagoPendiente->cuenta_id,
            'num_cuenta_destino' => $pagoPendiente->num_cuenta_destino,
            'concepto' => $pagoPendiente->concepto . ' (Vencido)',
            'monto' => $nuevoMonto,
            'fecha_generacion' => now(),
        ]);

        $pagoPendiente->delete();
        $this->info('Pago pendiente ID: ' . $pagoPendiente->id . ' movido a deudas.');
    }

    $this->info('Comando finalizado.');
})->purpose('Display an inspiring quote')->everyMinute();;