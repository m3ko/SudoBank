<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tripulantes;
use Illuminate\Http\RedirectResponse;

class TripulantesController extends Controller
{

    // public function index(){

    //     $tripulantes = Tripulantes::all();
    //     return view('tripulantes.index', compact('tripulantes'));
        
    // }


    public function store(Request $request): RedirectResponse
    {
        
 
        $tripulante = new Tripulantes;
 
        $tripulante->nombre = $request->nombre;
        $tripulante->apellido = $request->apellido;
        $tripulante->rol = $request->rol;
        $tripulante->fecha_incorporacion = $request->fecha_incorporacion;
        
 
        $tripulante->save();
 
        return redirect()->route('tripulantes.index')->with('success', 'Tripulante creado correctamente');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'apellidos' => 'required',
            'rol',
            'fecha_incorporacion',
            'fecha_baja',
            'created_at',
            'updated_at',
        ]);

        $tripulante = Post::find($id);
        $tripulante->update($request->all());

        return redirect()->route('tripulantes.index')
            ->with('success', 'Post updated successfully.');
    }
    

    // public function destroy($id) {
    //     /*DELETE*/
    //     /*Niko*/
    //     $tripulante = Tripulantes::find($id);
    //     $tripulante->delete();

    //     return redirect()->route('tripulantes.index')
    //     ->with('succes', 'Post deleted succesfully');
    // }

    // public function create() {
    //     /*comentario hola */

    // }

     // Mostrar todos los tripulantes
     public function index()
     {
         // Obtener todos los tripulantes de la base de datos
         $tripulantes = Tripulantes::all();
 
         // Pasar los tripulantes a la vista 'tripulantes.index'
         return view('tripulantes.index', compact('tripulantes'));
     }
     public function create()
     {
 
         return view('tripulantes.create');
     }
 
     // Crear un nuevo tripulante
    //  public function store(Request $request)
    //  {
    //      // Validar y crear el tripulante
    //      Tripulantes::create($request->all());
 
    //      return redirect()->route('tripulantes.index')->with('success', 'Tripulante creado correctamente');
    //  }
 
     // Actualizar un tripulante
    //  public function update(Request $request, Tripulantes $tripulante)
    //  {
    //      $tripulante->update($request->all());
 
    //      return redirect()->route('tripulantes.index')->with('success', 'Tripulante actualizado correctamente');
    //  }
 
     // Eliminar un tripulante
     public function destroy(Tripulantes $tripulante)
     {
         $tripulante->delete();
 
         return redirect()->route('tripulantes.index')->with('success', 'Tripulante eliminado correctamente');
     }


}
