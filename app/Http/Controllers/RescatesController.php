<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Rescates;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Routing\ControllerMiddlewareOptions;

class RescatesController extends Controller
{
    
    // Mostrar todos los Rescates
    public function index()
    {
        $rescates = Rescates::all();

        return view('rescates.index', compact('rescates'));
    }

    public function store(Request $request)
{
    // Validación para asegurarse de que el viajes_id es válido
    $request->validate([
        'fecha_hora_inicio' => 'required|date',
        'fecha_hora_fin' => 'required|date',
        'viajes_id' => 'required|exists:viajes,id',  // Validación de existencia
    ]);

    // Crear un nuevo rescate con los datos válidos
    $rescate = new Rescates();
    $rescate->fecha_hora_inicio = $request->fecha_hora_inicio;
    $rescate->fecha_hora_fin = $request->fecha_hora_fin;
    $rescate->viajes_id = $request->viajes_id;

    // Guardar el rescate
    $rescate->save();

    // Redirigir con mensaje de éxito
    return redirect()->route('rescates.index')->with('success', 'Rescate añadido correctamente');
}

    //Actualizar los datos
    public function update(Request $request, $id)
{
        // Validación para asegurarse de que el viajes_id es válido
        $request->validate([
            'fecha_hora_inicio' => 'required|date',
            'fecha_hora_fin' => 'required|date',
            'viajes_id' => 'required|exists:viajes,id',  // Validación de existencia
        ]);

        // Encontrar el rescate por su ID
        $rescate = Rescates::findOrFail($id);

        // Actualizar el rescate con los nuevos datos
        $rescate->fecha_hora_inicio = $request->fecha_hora_inicio;
        $rescate->fecha_hora_fin = $request->fecha_hora_fin;
        $rescate->viajes_id = $request->viajes_id;

        // Guardar los cambios
        $rescate->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('rescates.index')->with('success', 'Rescate actualizado correctamente');
    }

  
    public function edit(Request $request,$id) {

        if(auth()->user()->hasRole('editor')){  
        $rescate = Rescates::find($id);
        return view('rescates.edit', compact('rescate'));

    }else{
        abort(403); 
    }}
    

     public function create()
     {
 
         return view('rescates.create');
     }

     public function destroy(Rescates $rescate)
     {
         $rescate->delete();
 
         return redirect()->route('rescates.index')->with('success', 'Rescate eliminado correctamente');
     }


     public function show($id) {
        $rescate = Rescates::find($id);
        return view('rescates.show', compact('rescate'));
     }
     public function indexApi()
    {
        // Carga los rescates junto con sus relaciones (opcional)
        $rescates = Rescates::with('viajes', 'rescatados')->get();

        return response()->json($rescates, 200); // Respuesta en formato JSON
    }
}
