<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\tripulantes;

class TripulantesController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        
 
        $tripulante = new tripulante;
 
        $tripulante->nombre = $request->nombre;
        $tripulante->apellido = $request->apellido;
        $tripulante->rol = $request->rol;
        $tripulante->fecha_incorporacion = $request->fecha_incorporacion;

 
        $tripulante->save();
 
        return redirect('/tripulantes');
    }

    public function  update (Request $request, $id) {
        /*janire */
        $request->validate([
            'nombre'])
        $tripulante = Tripulante::($id);
        $tripulante->update($request->all());
        return redirect()->route('tripulantes.index')
        ->with('success', 'Post updated succesfully');
    }
    

    public function destroy($id) {
        /*DELETE*/
        /*Niko*/
        $tripulante = tripulantes::find($id);
        $tripulante->delete();
        $tripulante->store();

        return redirect()->route('tripulantes.index')
        ->with('succes', 'Post deleted succesfully');
    }

    public function create {
        /*comentario hola */

    }



}
