<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viajes;

use Illuminate\Http\RedirectResponse;

class ViajesController extends Controller
{
    
    // Mostrar todos los tripulantes
    public function index()
    {
        // Obtener todos los tripulantes de la base de datos
        $Viajes = Viajes::all();
  
        // Pasar los tripulantes a la vista 'tripulantes.index'
        return view('viajes.index', compact('Viajes'));
    }








}
