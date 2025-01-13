<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripulantesController extends Controller
{
    public function store(){
        /*INSTERT*/ 
        /*Aimar */
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
        $tripulante = Tripulante::find($id);
        $tripulante->delete();

        return redirect()->route('tripulantes.index')
        ->with('succes', 'Post deleted succesfully');
    }

    public function create {
        /*CREATE */

    }



}
