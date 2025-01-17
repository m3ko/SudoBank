<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tripulantes;
use Illuminate\Http\RedirectResponse;

class TripulantesController extends Controller
{

     // Mostrar todos los tripulantes
    public function index()
    {
        // Obtener todos los tripulantes de la base de datos
        $tripulantes = Tripulantes::all();

        // Pasar los tripulantes a la vista 'tripulantes.index'
        return view('tripulantes.index', compact('tripulantes'));
    }

    public function store(Request $request): RedirectResponse
    {
        
 
        $tripulante = new Tripulantes;
 
        $tripulante->nombre = $request->nombre;
        $tripulante->apellido = $request->apellido;
        $tripulante->rol = $request->rol;
        $tripulante->fecha_incorporacion = $request->fecha_incorporacion;
        $tripulante->fecha_baja = $request->fecha_baja;

 
        $tripulante->save();
 
        return redirect()->route('tripulantes.index')->with('success', 'Tripulante creado correctamente');
    }


     public function create()
     {
 
         return view('tripulantes.create');
     }
 
    
     // Actualizar un tripulante
     public function  update (Request $request, $id) {
        // $request->validate([
        //     'nombre'])
        // $tripulante = Tripulante::($id);
        // $tripulante->update($request->all());
        // return redirect()->route('tripulantes.index')
        // ->with('success', 'Post updated succesfully');
    }

      // // public function  update (Request $request, $id) {
    // //     /*janire */
    // //     $request->validate([
    // //         'nombre'])
    // //     $tripulante = Tripulantes::($id);
    // //     $tripulante->update($request->all());
    // //     return redirect()->route('tripulantes.index')
    // //     ->with('success', 'Post updated succesfully');
    // // }


 
     // Eliminar un tripulante
     public function destroy(Tripulantes $tripulante)
     {
         $tripulante->delete();
 
         return redirect()->route('tripulantes.index')->with('success', 'Tripulante eliminado correctamente');
     }


}
