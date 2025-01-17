<?php

namespace App\Http\Controllers;
use App\Models\Medicos;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class MedicosController extends Controller
{   

    //Mostrar todos los médicos
    public function index()
    {
        // Obtener todos los medicos de la base de datos
        $medicos = Medicos::all();

        // Pasar los médicos a la vista 'médicos.index'
        return view('medicos.index', compact('medicos'));
    }


    //Elimina un médico seleccionado
    public function destroy(Medicos $medico)
     {
         $medico->delete();
        //redirige al index
         return redirect()->route('medicos.index')->with('success', 'Medico eliminado correctamente');
     }

    //Añade un médico nuevo
    public function store(Request $request): RedirectResponse
     {
         
  
         $medico = new Medicos;
  
         $medico->nombre = $request->nombre;
         $medico->apellido = $request->apellido;
         $medico->fecha_incorporacion = $request->fecha_incorporacion;
         $medico->fecha_baja = $request->fecha_baja;
  
         $medico->save();
        //redirige al index
         return redirect()->route('medicos.index')->with('success', 'Médico creado correctamente');
     }

    public function create()
     {
        //redirige al formulario para crear un nuevo médico
         return view('medicos.create');
     }

    public function update(Request $request, $id)
    {
        //Se validan los datos enviados al form
        $request->validate([
            'nombre',
            'apellidos',
            'rol' ,
            'fecha_incorporacion',
            'fecha_baja',
            'created_at',
            'updated_at',
        ]);

        //Buscar registro en la BBDD
        $medico = Medicos::find($id);
        $medico->update($request->all());

        return redirect()->route('medicos.index')
            ->with('success', 'Post updated successfully.');
    }

    public function edit($id) {
        $medico = Medicos::find($id);
        //Devuelve la vista medico. Compact: Crea un array con los datos de 
        //medico y los pasa a la vista para mostrarlos en el form a editar
        return view('medicos.edit', compact('medico'));
    }

}
