<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viajes;
use App\Models\Tripulantes;
use App\Models\Medicos;
use Illuminate\Http\RedirectResponse;

class BizumController extends Controller
{
    public function index()
    {
        $bizums = Bizum::with(['emisor', 'receptor'])->get();
        return view('bizums.index', compact('bizums'));
    }

    public function create()
    {
        return view('bizums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_emisor' => 'required|exists:usuarios,id',
            'id_receptor' => 'required|exists:usuarios,id|different:id_emisor',
            'cuenta_emisor' => 'required|string|exists:cuentas_bancarias,num_cuenta',
            'cuenta_receptor' => 'required|string|exists:cuentas_bancarias,num_cuenta',
            'fecha_hora' => 'required|date',
        ]);

        Bizum::create($request->all());
        return redirect()->route('bizums.index')->with('success', 'Transacción Bizum añadida correctamente');
    }

    public function show($id)
    {
        $bizum = Bizum::findOrFail($id);
        return view('bizums.show', compact('bizum'));
    }

    public function edit($id)
    {
        $bizum = Bizum::findOrFail($id);
        return view('bizums.edit', compact('bizum'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_emisor' => 'required|exists:usuarios,id',
            'id_receptor' => 'required|exists:usuarios,id|different:id_emisor',
            'cuenta_emisor' => 'required|string|exists:cuentas_bancarias,num_cuenta',
            'cuenta_receptor' => 'required|string|exists:cuentas_bancarias,num_cuenta',
            'fecha_hora' => 'required|date',
        ]);

        $bizum = Bizum::findOrFail($id);
        $bizum->update($request->all());
        return redirect()->route('bizums.index')->with('success', 'Transacción Bizum actualizada correctamente');
    }

    public function destroy($id)
    {
        $bizum = Bizum::findOrFail($id);
        $bizum->delete();
        return redirect()->route('bizums.index')->with('success', 'Transacción Bizum eliminada correctamente');
    }

     public function indexApi()
    {
        $viajes = Viajes::with('tripulantes')->get(); // Carga las relaciones
        return response()->json($viajes); // Retorna los datos en formato 
        // return Viajes::with('tripulantes')->get();
    }
     
}

