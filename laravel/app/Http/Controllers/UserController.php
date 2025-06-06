<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Routing\ControllerMiddlewareOptions;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    
public function store(Request $request)
{   
    $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'direccion' => 'required|string|max:255',
        'telefono' => 'required|string|max:15',
        'email' => 'required|email|unique:users,email',
        'rol' => 'required|in:visor,admin',
        'password' => 'required|string|min:8|confirmed',
    ]);

    \App\Models\User::create([
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'direccion' => $request->direccion,
        'telefono' => $request->telefono,
        'email' => $request->email,
        'rol' => $request->rol,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('usuarios.index')->with('success', 'Usuario añadido correctamente');
}

    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|unique:usuarios,correo,' . $id,
            'rol' => 'required|in:visor,admin',
        ]);

        $usuario = User::findOrFail($id);
        $usuario->update($request->all());
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente');
    }

    
    public function indexApi(){
        // Carga los rescatados junto con sus relaciones, si existen
        $rescatados = User::with('rescates')->get();

        return response()->json($rescatados, 200); // Respuesta en formato JSON
    }

}
