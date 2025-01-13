<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripulantesController extends Controller
{
    public function store(){
        /*INSTERT*/ 
        /*Aimar */
    }

    public function  update {

    }

    public function destroy($id) {
        /*DELETE*/
        /*Niko*/
        $tripulante = tripulantes::find($id);
        $tripulante->delete();

        return redirect()->route('tripulantes.index')
        ->with('succes', 'Post deleted succesfully');
    }

    public function create {
        /*CREATE */

    }



}
