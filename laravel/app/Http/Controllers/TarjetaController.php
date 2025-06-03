<?php

namespace App\Http\Controllers;
use App\Models\Tarjeta;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Models\CuentaBancaria;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Routing\ControllerMiddlewareOptions;



class TarjetaController extends Controller
{
    public function index()
    {
        $tarjetas = Tarjeta::with('cuentaBancaria')->get();
        return view('tarjetas.index', compact('tarjetas'));
    }

    public function create()
    {
        return view('tarjetas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cuenta_bancaria_id' => 'required|exists:cuentas_bancarias,id',
            'tipo_tarjeta' => 'required|in:credito,debito',
            'fecha_expiracion' => 'required|date|after:today',
        ]);

        Tarjeta::create($request->all());
        return redirect()->route('tarjetas.index')->with('success', 'Tarjeta añadida correctamente');
    }

    public function show($id)
    {
        $tarjeta = Tarjeta::findOrFail($id);
        return view('tarjetas.show', compact('tarjeta'));
    }

    public function edit($id)
    {
        $tarjeta = Tarjeta::findOrFail($id);
        return view('tarjetas.edit', compact('tarjeta'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cuenta_bancaria_id' => 'required|exists:cuentas_bancarias,id',
            'tipo_tarjeta' => 'required|in:credito,debito',
            'fecha_expiracion' => 'required|date|after:today',
        ]);

        $tarjeta = Tarjeta::findOrFail($id);
        $tarjeta->update($request->all());
        return redirect()->route('tarjetas.index')->with('success', 'Tarjeta actualizada correctamente');
    }

    public function destroy($id)
    {
        $tarjeta = Tarjeta::findOrFail($id);
        $tarjeta->delete();
        return redirect()->route('tarjetas.index')->with('success', 'Tarjeta eliminada correctamente');
    }
}