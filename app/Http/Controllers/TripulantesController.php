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
        try {
            // Crear y guardar el nuevo tripulante
            $tripulante = new Tripulantes;

            $tripulante->nombre = $request->nombre;
            $tripulante->apellido = $request->apellido;
            $tripulante->rol = $request->rol;
            $tripulante->fecha_incorporacion = $request->fecha_incorporacion;
            $tripulante->fecha_baja = $request->fecha_baja;

            $tripulante->save();

            // Mensaje de éxito
            return redirect()
                ->route('tripulantes.create')
                ->with('success', 'Tripulante creado correctamente.');
        } catch (\Exception $e) {
            // Mensaje de error
            return redirect()
                ->route('tripulantes.create')
                ->with('error', 'No fue posible crear el tripulante. Inténtalo nuevamente.');
        }

}

    //Actualizar los datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre',
            'apellidos',
            'rol' ,
            'fecha_incorporacion',
            'fecha_baja',
            'created_at',
            'updated_at'
        ]);

        //Buscar registro en la BBDD
        $tripulante = Tripulantes::find($id);
        $tripulante->update($request->all());

        return redirect()->route('tripulantes.index')
        ->with('success', 'Post updated successfully.');
    }

    //Editar los datos en el formulario
    public function edit(Request $request,$id) {

        if(auth()->user()->can('añadir entidad')){  

        //Obtener todos los tripulantes de la BBDD
        $tripulante = Tripulantes::find($id);
        //Pasar los tripulantes a la vista
        return view('tripulantes.edit', compact('tripulante'));
    }else{
        abort(403);
    }}
    

     public function create()
     {
 
         return view('tripulantes.create');
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


     public function show($id) {
        $tripulante = Tripulantes::find($id);
        return view('tripulantes.show', compact('tripulante'));
     }

}
