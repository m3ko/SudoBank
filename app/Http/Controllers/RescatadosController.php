<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rescatados;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Routing\ControllerMiddlewareOptions;

class RescatadosController extends Controller
{
    public function index()
    {
        // Obtener todos los rescatados de la base de datos
        $rescatados = Rescatados::all();

        // Pasar los rescatados a la vista 'tripulantes.index'
        return view('rescatados.index', compact('rescatados'));
    }

    public function create()
     {
 
         return view('rescatados.create');
     }


    public function store(Request $request): RedirectResponse
    {
     if(auth()->user()->hasRole('editor')){  

    //try {
 
        $rescatado = new Rescatados;
 
        $rescatado->nombre = $request->nombre;
        $rescatado->apellido = $request->apellido;
        $rescatado->foto = $request->foto;
        $rescatado->edad = $request->edad;
        $rescatado->sexo = $request->sexo;
        $rescatado->procedencia = $request->procedencia;
        $rescatado->valoracion_medica = $request->valoracion_medica;
        $rescatado->medicos_id = $request->medicos_id;
        $rescatado->rescates_id = $request->rescates_id;


 
        $rescatado->save();
        //redirige al index
        return redirect()
            ->route('rescatados.create')
            ->with('success', 'Rescatado creado correctamente.');
        // } catch (\Exception $e) {
        //  // Mensaje de error
        //     return redirect()
        //         ->route('rescatados.create')
        //         ->with('error', 'No fue posible crear el rescatado. Inténtalo nuevamente.');
         //}
        }

        
    }
    public function edit(Request $request,$id) {

        if(auth()->user()->hasRole('editor')){  
        $rescatado = Rescatados::find($id);
        return view('rescatados.edit', compact('rescatado'));

    }else{
        abort(403); 
    }}
    public function update(Request $request, $id)
{
    // Validar los datos enviados desde el formulario
    $request->validate([
        'nombre',
        'apellido',
        'foto', // Opcional
        'edad',
        'sexo', // Solo puede ser M o F
        'procedencia' ,
        'valoracion_medica',
        'medicos_id', // Debe existir en la tabla `medicos`
        'rescates_id' // Debe existir en la tabla `rescates`
    ]);

    // Buscar el registro en la base de datos
    $rescatado = Rescatados::find($id);

    // Actualizar el registro con los datos enviados
    $rescatado->update($request->all());

    // Redirigir con un mensaje de éxito
    return redirect()->route('rescatados.index')
        ->with('success', 'Rescatado actualizado exitosamente.');
}
    
    public function indexApi(){
        // Carga los rescatados junto con sus relaciones, si existen
        $rescatados = Rescatados::with('rescates')->get();

        return response()->json($rescatados, 200); // Respuesta en formato JSON
    }




















}
