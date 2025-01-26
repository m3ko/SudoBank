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
 
    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'foto' => 'nullable|string|url',
        'edad' => 'required|integer|min:0',
        'sexo' => 'required|in:Masculino,Femenino',
        'procedencia' => 'required|string|max:255',
        'valoracion_medica' => 'required|string|max:255',
        'medicos_id' => 'required|exists:medicos,id',  // Validación para que la ID de médico exista
        'rescates_id' => 'required|exists:rescates,id', // Validación para que la ID de rescate exista
    ]);

    // Si la validación pasa, asignar los valores al modelo
    $rescatado = new Rescatados;

    $rescatado->nombre = $validated['nombre'];
    $rescatado->apellido = $validated['apellido'];
    $rescatado->foto = $validated['foto'];
    $rescatado->edad = $validated['edad'];
    $rescatado->sexo = $validated['sexo'];
    $rescatado->procedencia = $validated['procedencia'];
    $rescatado->valoracion_medica = $validated['valoracion_medica'];
    $rescatado->medicos_id = $validated['medicos_id'];
    $rescatado->rescates_id = $validated['rescates_id'];

    // Guardar el rescatado
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
    // Validar si los IDs existen
    $request->validate([
        'medicos_id' => 'exists:medicos,id',
        'rescates_id' => 'exists:rescates,id',
    ]);

    // Obtener el rescatado
    $rescatado = Rescatados::findOrFail($id);

    // Actualizar los campos del rescatado
    $rescatado->nombre = $request->nombre;
    $rescatado->apellido = $request->apellido;
    $rescatado->foto = $request->foto;
    $rescatado->edad = $request->edad;
    $rescatado->sexo = $request->sexo;
    $rescatado->procedencia = $request->procedencia;
    $rescatado->valoracion_medica = $request->valoracion_medica;
    $rescatado->medicos_id = $request->medicos_id;
    $rescatado->rescates_id = $request->rescates_id;

    // Guardar los cambios
    $rescatado->save();

    // Redirigir con éxito
    return redirect()->route('rescatados.index')->with('success', 'Rescatado actualizado correctamente');
}

    public function show($id)
    {
        // Buscar el rescatado por su id
        $rescatado = Rescatados::findOrFail($id);
        
        // Retornar la vista con los datos del rescatado
        return view('rescatados.show', compact('rescatado'));
    }

    public function destroy(Rescatados $rescatado)
     {
         $rescatado->delete();
 
         return redirect()->route('rescatados.index')->with('success', 'Rescatados eliminado correctamente');
     }
    
    public function indexApi(){
        // Carga los rescatados junto con sus relaciones, si existen
        $rescatados = Rescatados::with('rescates')->get();

        return response()->json($rescatados, 200); // Respuesta en formato JSON
    }




















}
