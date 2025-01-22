<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viajes;
use App\Models\Tripulantes;
use App\Models\Medicos;
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
    try {
        
 
        $viaje = new viajes;
 
        $viaje->origen = $request->origen;
        $viaje->destino = $request->destino;
        $viaje->fecha_hora = $request->fechaHora;
        
 
        $viaje->save();
 
  // Mensaje de éxito
        return redirect()
            ->route('viajes.create')
            ->with('success', 'Viaje creado correctamente.');
    } catch (\Exception $e) {
            // Mensaje de error
            return redirect()
                ->route('viajes.create')
                ->with('error', 'No fue posible crear el viaje. Inténtalo nuevamente.');
        }
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





     public function update(Request $request, $id)
     {
         //Se validan los datos enviados al form
         $request->validate([
             'origen',
             'destino',
             'fecha_hora' ,
         ]);
 
         //Buscar registro en la BBDD
         $viaje = Viajes::find($id);
         $viaje->update($request->all());
 
         return redirect()->route('viajes.index')
             ->with('success', 'Post updated successfully.');
     }
 
     public function edit($id) {
         $viaje = Viajes::find($id);
         //Devuelve la vista medico. Compact: Crea un array con los datos de 
         //medico y los pasa a la vista para mostrarlos en el form a editar
         return view('viajes.edit', compact('viaje'));
     }

     public function show($id) {
        $viaje = Viajes::findOrFail($id);

        // Obtén todos los tripulantes disponibles
        $todosTripulantes = Tripulantes::all();
        $todosMedicos = Medicos::all();

        // Retorna la vista pasando el viaje y los tripulantes
        return view('viajes.show', compact('viaje', 'todosTripulantes', 'todosMedicos'));
     }
     
     public function addTripulantes(Request $request, $viajeId)
     {
         // Encuentra el viaje por su ID
         $viaje = Viajes::findOrFail($viajeId);
 
         // Valida que se envíen tripulantes
         $request->validate([
             'tripulantes' => 'required|array',
             'tripulantes.*' => 'exists:tripulantes,id',
         ]);
 
         // Añade los tripulantes seleccionados al viaje
         $viaje->tripulantes()->syncWithoutDetaching($request->input('tripulantes'));
 
         // Redirige con un mensaje de éxito
         return redirect()->route('viajes.show', $viajeId)->with('success', 'Tripulantes añadidos exitosamente al viaje.');
     }

     public function addMedicos(Request $request, $viajeId)
     {
         // Encuentra el viaje por su ID
         $viaje = Viajes::findOrFail($viajeId);
 
         // Valida que se envíen tripulantes
         $request->validate([
             'medicos' => 'required|array',
             'medicos.*' => 'exists:medicos,id',
         ]);
 
         // Añade los tripulantes seleccionados al viaje
         $viaje->medicos()->syncWithoutDetaching($request->input('medicos'));
 
         // Redirige con un mensaje de éxito
         return redirect()->route('viajes.show', $viajeId)->with('success', 'medicos añadidos exitosamente al viaje.');
     }
     
}

