<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CuentaBancaria;
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
        $cuentas = CuentaBancaria::with('usuario')->get();
        return view('cuentas.index', compact('cuentas'));
    }

    public function create()
    {
        return view('cuentas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:usuarios,id',
            'saldo' => 'required|numeric|min:0',
            'num_cuenta' => 'required|string|unique:cuentas_bancarias,num_cuenta',
            'tipo_moneda' => 'required|string|max:3',
        ]);

        CuentaBancaria::create($request->all());
        return redirect()->route('cuentas.index')->with('success', 'Cuenta bancaria añadida correctamente');
    }

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
}