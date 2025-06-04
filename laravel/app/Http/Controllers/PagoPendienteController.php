<?php
namespace App\Http\Controllers;

use App\Models\PagoPendiente;
use App\Models\CuentaBancaria;
use Illuminate\Http\Request;

class PagoPendienteController extends Controller
{   

    public function show($id)
{
    $pagoPendiente = PagoPendiente::findOrFail($id);
    return view('pagos_pendientes.show', compact('pagoPendiente'));
}
    public function index()
    {
        $pagosPendientes = PagoPendiente::with('cuenta')->get();
        return view('pagos_pendientes.index', compact('pagosPendientes'));
    }

    public function create()
    {
        $cuentas = CuentaBancaria::all();
        return view('pagos_pendientes.create', compact('cuentas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cuenta_id' => 'required|exists:cuentas_bancarias,id',
            'num_cuenta_destino' => 'required|string',
            'concepto' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0.01',
            'fecha_vencimiento' => 'required|date',
        ]);

        PagoPendiente::create($request->all());
        return redirect()->route('pagos_pendientes.index')->with('success', 'Pago pendiente creado correctamente.');
    }

    public function edit($id)
    {
        $pagoPendiente = PagoPendiente::findOrFail($id);
        $cuentas = CuentaBancaria::all();
        return view('pagos_pendientes.edit', compact('pagoPendiente', 'cuentas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cuenta_id' => 'required|exists:cuentas_bancarias,id',
            'num_cuenta_destino' => 'required|string',
            'concepto' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0.01',
            'fecha_vencimiento' => 'required|date',
        ]);

        $pagoPendiente = PagoPendiente::findOrFail($id);
        $pagoPendiente->update($request->all());
        return redirect()->route('pagos_pendientes.index')->with('success', 'Pago pendiente actualizado correctamente.');
    }

    public function destroy($id)
    {
        $pagoPendiente = PagoPendiente::findOrFail($id);
        $pagoPendiente->delete();
        return redirect()->route('pagos_pendientes.index')->with('success', 'Pago pendiente eliminado correctamente.');
    }

    public function pagarPagoPendiente($id)
    {
        $pagoPendiente = PagoPendiente::findOrFail($id);
        $cuenta = CuentaBancaria::findOrFail($pagoPendiente->cuenta_id);

        if ($cuenta->saldo >= $pagoPendiente->monto) {
            // Crear una nueva transacción bancaria
            TransaccionBancaria::create([
                'cuenta_id' => $cuenta->id,
                'num_cuenta_destino' => $pagoPendiente->num_cuenta_destino,
                'concepto' => $pagoPendiente->concepto,
                'monto' => $pagoPendiente->monto,
                'fecha' => now(),
            ]);

            // Restar el monto del pago pendiente del saldo de la cuenta bancaria
            $cuenta->update(['saldo' => $cuenta->saldo - $pagoPendiente->monto]);

            // Eliminar el pago pendiente
            $pagoPendiente->delete();

            return redirect()->route('pagos_pendientes.index')->with('success', 'Pago pendiente realizado correctamente.');
        } else {
            return redirect()->route('pagos_pendientes.index')->with('error', 'Saldo insuficiente para realizar el pago.');
        }
    }

    public function moverPagosPendientesAVencidos()
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

    return redirect()->route('pagos_pendientes.index')->with('success', 'Pagos pendientes vencidos movidos a deudas correctamente.');
}
    
}