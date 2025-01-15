<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viajes;

use Illuminate\Http\RedirectResponse;

class ViajesController extends Controller
{
    
    // Mostrar todos los tripulantes
    public function index()
    {
        // Obtener todos los tripulantes de la base de datos
        $viajes = viajes::all();
  
        // Pasar los tripulantes a la vista 'tripulantes.index'
        return view('viajes.index', compact('viajes'));
    }

    public function store(Request $request): RedirectResponse
    {
        
 
        $viaje = new viajes;
 
        $viaje->origen = $request->origen;
        $viaje->destino = $request->destino;
        $viaje->fecha_hora = $request->fechaHora;
        
 
        $viaje->save();
 
        return redirect()->route('viajes.index')->with('success', 'viaje creado correctamente');
    }

    public function create()
     {
 
         return view('viajes.create');
     }





     
     public function destroy(Viajes $viaje)
     {
         $viaje->delete();
 
         return redirect()->route('viajes.index')->with('success', 'Viaje eliminado correctamente');
     }








}
