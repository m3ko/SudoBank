<?php
namespace App\Http\Controllers;

use App\Models\TransaccionBancaria;
use App\Models\CuentaBancaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaccionBancariaController extends Controller
{
    public function index()
    {
        $transacciones = TransaccionBancaria::with('cuenta')->get();
        return view('transacciones.index', compact('transacciones'));
    }

    public function create()
    {
        $cuentas = CuentaBancaria::all();
        return view('transacciones.create', compact('cuentas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cuenta_id' => 'required|exists:cuentas_bancarias,id',
            'num_cuenta_destino' => 'required|string',
            'concepto' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0.01',
            'fecha' => 'required|date',
        ]);

        TransaccionBancaria::create($request->all());
        return redirect()->route('transacciones.index')->with('success', 'Transacción creada correctamente.');
    }

    public function edit($id)
    {
        $transaccion = TransaccionBancaria::findOrFail($id);
        $cuentas = CuentaBancaria::all();
        return view('transacciones.edit', compact('transaccion', 'cuentas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cuenta_id' => 'required|exists:cuentas_bancarias,id',
            'num_cuenta_destino' => 'required|string',
            'concepto' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0.01',
            'fecha' => 'required|date',
        ]);

        $transaccion = TransaccionBancaria::findOrFail($id);
        $transaccion->update($request->all());
        return redirect()->route('transacciones.index')->with('success', 'Transacción actualizada correctamente.');
    }

    public function destroy($id)
    {
        $transaccion = TransaccionBancaria::findOrFail($id);
        $transaccion->delete();
        return redirect()->route('transacciones.index')->with('success', 'Transacción eliminada correctamente.');
    }

    public function show($id)
    {
        $transaccion = TransaccionBancaria::findOrFail($id);
        return view('transacciones.show', compact('transaccion'));
    }


    public function latestTransfers()
    {
        $user = Auth::user(); // Usuario autenticado
    
        // Obtener las cuentas bancarias asociadas al usuario autenticado
        $cuentas = CuentaBancaria::where('user_id', $user->id)->pluck('id'); // Obtener solo los IDs de las cuentas
        // Obtener las transacciones asociadas a las cuentas bancarias del usuario
        $transfers = TransaccionBancaria::whereIn('cuenta_id', $cuentas)
            ->latest('fecha') // Ordenar por fecha descendente
            ->get();
            
        return view('home.index', compact('transfers'));
    }
}