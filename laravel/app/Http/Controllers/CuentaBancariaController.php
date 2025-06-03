<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CuentaBancaria;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Routing\ControllerMiddlewareOptions;


class CuentaBancariaController extends Controller
{
    public function index()
    {
        $cuentas = CuentaBancaria::with('user')->get();
        return view('cuentas.index', compact('cuentas'));
    }

    public function create()
    {
        $usuarios = User::all(); // Obtén todos los usuarios
        return view('cuentas.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $num_cuenta = $this->generarNumeroCuenta();
        $request->merge(['num_cuenta' => $num_cuenta]); // Agregar el número generado al request

        \Log::info('Datos recibidos en el formulario:', $request->all());

        $request->validate([
            'user_id' => 'required|exists:usuarios,id',
            'saldo' => 'required|numeric',
            'tipo_moneda' => 'required|string|max:3',
        ]);
    
        try {
            // Generar un número de cuenta único
            \Log::info('Número de cuenta generado:', ['num_cuenta' => $num_cuenta]);
    
            // Crear la cuenta bancaria
            $cuenta = CuentaBancaria::create([
                'user_id' => $request->user_id,
                'saldo' => $request->saldo,
                'num_cuenta' => $num_cuenta,
                'tipo_moneda' => $request->tipo_moneda,
            ]);
    
            \Log::info('Cuenta bancaria creada correctamente:', $cuenta->toArray());
    
            return redirect()->route('cuentas.index')->with('success', 'Cuenta bancaria añadida correctamente. Número de cuenta: ' . $num_cuenta);
        } catch (\Exception $e) {
            \Log::error('Error al guardar la cuenta bancaria:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Ocurrió un error al guardar la cuenta bancaria. Por favor, inténtelo de nuevo.');
        }}

    public function show($id)
    {
        $cuenta = CuentaBancaria::findOrFail($id);
        return view('cuentas.show', compact('cuenta'));
    }

    public function edit($id)
    {
        $cuenta = CuentaBancaria::findOrFail($id);
        return view('cuentas.edit', compact('cuenta'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:usuarios,id',
            'saldo' => 'required|numeric|min:0',
            'num_cuenta' => 'required|string|unique:cuentas_bancarias,num_cuenta,' . $id,
            'tipo_moneda' => 'required|string|max:3',
        ]);

        $cuenta = CuentaBancaria::findOrFail($id);
        $cuenta->update($request->all());
        return redirect()->route('cuentas.index')->with('success', 'Cuenta bancaria actualizada correctamente');
    }

    public function destroy($id)
    {
        $cuenta = CuentaBancaria::findOrFail($id);
        $cuenta->delete();
        return redirect()->route('cuentas.index')->with('success', 'Cuenta bancaria eliminada correctamente');
    }

    private function generarIBAN()
{
    do {
        // Código del país (España: ES)
        $codigoPais = 'ES';

        // Código de control (2 dígitos)
        $codigoControl = str_pad(random_int(0, 99), 2, '0', STR_PAD_LEFT);

        // Número de cuenta bancaria (20 dígitos) generado en partes
        $numeroCuenta = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT) . // 8 dígitos
                        str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT) . // 8 dígitos
                        str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);      // 4 dígitos

        // Generar el IBAN completo
        $iban = $codigoPais . $codigoControl . $numeroCuenta;

    } while (CuentaBancaria::where('num_cuenta', $iban)->exists()); // Asegurarse de que sea único

    return $iban;
}
}