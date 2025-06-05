<?php
namespace App\Http\Controllers;

use App\Models\Deuda;
use App\Models\CuentaBancaria;
use Illuminate\Http\Request;
use App\Models\TransaccionBancaria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DeudaController extends Controller
{   

    public function index()
    {
        $deudas = Deuda::with('cuenta')->get();
        return view('deudas.index', compact('deudas'));
    }

    public function create()
    {
        $cuentas = CuentaBancaria::all();
        return view('deudas.create', compact('cuentas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cuenta_id' => 'required|exists:cuentas_bancarias,id',
            'num_cuenta_destino' => 'required|string',
            'concepto' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0.01',
            'fecha_generacion' => 'required|date',
        ]);

        Deuda::create($request->all());
        return redirect()->route('deudas.index')->with('success', 'Deuda creada correctamente.');
    }

    public function edit($id)
    {
        $deuda = Deuda::findOrFail($id);
        $cuentas = CuentaBancaria::all();
        return view('deudas.edit', compact('deuda', 'cuentas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cuenta_id' => 'required|exists:cuentas_bancarias,id',
            'num_cuenta_destino' => 'required|string',
            'concepto' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0.01',
            'fecha_generacion' => 'required|date',
        ]);

        $deuda = Deuda::findOrFail($id);
        $deuda->update($request->all());
        return redirect()->route('deudas.index')->with('success', 'Deuda actualizada correctamente.');
    }

    public function destroy($id)
    {
        $deuda = Deuda::findOrFail($id);
        $deuda->delete();
        return redirect()->route('deudas.index')->with('success', 'Deuda eliminada correctamente.');
    }

    public function show($id)
    {
        $transaccion = TransaccionBancaria::findOrFail($id);
        return view('transacciones.show', compact('transaccion'));
    }

    public function pagarDeuda($id)
{
   $deuda = Deuda::findOrFail($id);
    $cuenta = CuentaBancaria::findOrFail($deuda->cuenta_id);

    if ($cuenta->saldo >= $deuda->monto) {
        // Crear una nueva transacción bancaria
        TransaccionBancaria::create([
            'cuenta_id' => $cuenta->id,
            'num_cuenta_destino' => $deuda->num_cuenta_destino,
            'concepto' => $deuda->concepto,
            'monto' => $deuda->monto,
            'fecha' => now(),
        ]);

        // Restar el monto de la deuda del saldo de la cuenta bancaria
        $cuenta->update(['saldo' => $cuenta->saldo - $deuda->monto]);

        // Eliminar la deuda
        $deuda->delete();

        $mensaje = ['success' => 'Deuda pagada correctamente.'];
    } else {
        $mensaje = ['error' => 'Saldo insuficiente para pagar la deuda.'];
    }

    // Redirección según el rol
    $user = Auth::user();
    if ($user->role === 'visor') {
        return redirect()->route('notificaciones.home')->with($mensaje);
    } else if ($user->role === 'admin') {
        return redirect()->route('deudas.index')->with($mensaje);
    } else {
        // Por defecto, redirigir a notificaciones
        return redirect()->route('notificaciones.home')->with($mensaje);
    }
}
}