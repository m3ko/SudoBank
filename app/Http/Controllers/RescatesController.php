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

    public function store(Request $request): RedirectResponse
    {
     if(auth()->user()->hasRole('editor')){  

    try {
 
        $rescate = new Rescates;
 
        $rescate->fecha_hora_inicio = $request->fecha_hora_inicio;
        $rescate->fecha_hora_fin = $request->fecha_hora_fin;
        $rescate->viajes_id = $request->viajes_id;

 
        $rescate->save();
        //redirige al index
        return redirect()
            ->route('rescates.create')
            ->with('success', 'Rescate creado correctamente.');
        } catch (\Exception $e) {
         // Mensaje de error
            return redirect()
                ->route('rescates.create')
                ->with('error', 'No fue posible crear el Rescate. Inténtalo nuevamente.');
        }
        }
    }

    //Actualizar los datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_hora_inicio',
            'fecha_hora_fin',
            'viajes_id'
        ]);

        //Buscar registro en la BBDD
        $rescate = Rescates::find($id);
        $rescate->update($request->all());

        return redirect()->route('rescates.index')
        ->with('success', 'Post updated successfully.');
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
}
