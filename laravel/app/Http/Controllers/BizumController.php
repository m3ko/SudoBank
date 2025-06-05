<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bizum;
use App\Models\User;
use App\Models\CuentaBancaria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class BizumController extends Controller
{
    public function index()
    {
        $bizums = Bizum::with(['emisor', 'receptor'])->get();
        return view('bizums.index', compact('bizums'));
    }

    public function create()
    {
        $users = User::with('cuentasBancarias')->get(); // Obtén usuarios con sus cuentas bancarias

    // Formatear las cuentas para pasarlas al frontend
        $cuentas = $users->mapWithKeys(function ($user) {
            return [$user->id => $user->cuentasBancarias->map(function ($cuenta) {
                return [
                    'id' => $cuenta->id,
                    'num_cuenta' => $cuenta->num_cuenta,
                ];
            })];
        });

    return view('bizums.create', compact('users', 'cuentas'));
    }

    public function store(Request $request)
    {
        \Log::info('Datos recibidos:', $request->all());

        $request->validate([
            'id_emisor' => 'required|exists:users,id',
            'id_receptor' => 'required|exists:users,id|different:id_emisor',
            'cuenta_emisor' => 'required|exists:cuentas_bancarias,num_cuenta',
            'cuenta_receptor' => 'required|exists:cuentas_bancarias,num_cuenta',
            'monto' => 'required|numeric|min:0.01',
        ]);

        $cuentaEmisor = CuentaBancaria::where('num_cuenta', $request->cuenta_emisor)->first();
        $cuentaReceptor = CuentaBancaria::where('num_cuenta', $request->cuenta_receptor)->first();

        // Verificar que el emisor tenga saldo suficiente
        if ($cuentaEmisor->saldo < $request->monto) {
            return redirect()->back()->with('error', 'El emisor no tiene saldo suficiente para realizar el Bizum.');
        }

        // Restar saldo al emisor y sumar al receptor
        $cuentaEmisor->saldo -= $request->monto;
        $cuentaReceptor->saldo += $request->monto;

        $cuentaEmisor->save();
        $cuentaReceptor->save();

        // Crear el Bizum
        Bizum::create($request->all());

        return redirect()->route('bizums.index')->with('success', 'Bizum creado correctamente.');
    }

    public function show($id)
    {
        $bizum = Bizum::findOrFail($id);
        return view('bizums.show', compact('bizum'));
    }

    public function edit($id)
{
    $bizum = Bizum::findOrFail($id);
    $users = User::with('cuentasBancarias')->get(); // Obtener usuarios con sus cuentas bancarias

    // Formatear las cuentas para pasarlas a la vista
    $cuentas = $users->mapWithKeys(function ($user) {
        return [$user->id => $user->cuentasBancarias->map(function ($cuenta) {
            return [
                'id' => $cuenta->id,
                'num_cuenta' => $cuenta->num_cuenta,
            ];
        })];
    });

    return view('bizums.edit', compact('bizum', 'users', 'cuentas'));
}

    public function update(Request $request, $id)
    {
        \Log::info('Datos recibidos para actualizar:', $request->all());

        $request->validate([
            'id_emisor' => 'required|exists:users,id',
            'id_receptor' => 'required|exists:users,id|different:id_emisor',
            'cuenta_emisor' => 'required|exists:cuentas_bancarias,num_cuenta',
            'cuenta_receptor' => 'required|exists:cuentas_bancarias,num_cuenta',
            'monto' => 'required|numeric|min:0.01',
        ]);

        $bizum = Bizum::findOrFail($id);

        $cuentaEmisor = CuentaBancaria::where('num_cuenta', $bizum->cuenta_emisor)->first();
        $cuentaReceptor = CuentaBancaria::where('num_cuenta', $bizum->cuenta_receptor)->first();

        // Revertir el saldo del Bizum anterior
        $cuentaEmisor->saldo += $bizum->monto;
        $cuentaReceptor->saldo -= $bizum->monto;

        $cuentaEmisor->save();
        $cuentaReceptor->save();

        // Actualizar las cuentas si cambiaron
        $nuevaCuentaEmisor = CuentaBancaria::where('num_cuenta', $request->cuenta_emisor)->first();
        $nuevaCuentaReceptor = CuentaBancaria::where('num_cuenta', $request->cuenta_receptor)->first();

        // Aplicar el nuevo saldo
        $nuevaCuentaEmisor->saldo -= $request->monto;
        $nuevaCuentaReceptor->saldo += $request->monto;

        $nuevaCuentaEmisor->save();
        $nuevaCuentaReceptor->save();

        // Actualizar el Bizum
        $bizum->update($request->all());

        return redirect()->route('bizums.index')->with('success', 'Bizum actualizado correctamente.');
    }

    public function destroy($id)
    {
        $bizum = Bizum::findOrFail($id);
        $bizum->delete();
        return redirect()->route('bizums.index')->with('success', 'Transacción Bizum eliminada correctamente');
    }

     public function indexApi()
    {
        $viajes = Viajes::with('tripulantes')->get(); // Carga las relaciones
        return response()->json($viajes); // Retorna los datos en formato 
        // return Viajes::with('tripulantes')->get();
    }

    public function infoHome()
{
    $user = Auth::user(); // Usuario autenticado

    // Obtener todos los usuarios excepto el usuario autenticado
    $usuarios = User::where('id', '!=', $user->id)->get();

    // Obtener las cuentas bancarias del usuario autenticado
    $cuentasUsuarios = CuentaBancaria::where('user_id', $user->id)->get();

    // Obtener las transacciones Bizum asociadas al usuario autenticado (enviadas o recibidas)
    $bizums = Bizum::where('id_emisor', $user->id)
        ->orWhere('id_receptor', $user->id)
        ->with(['emisor', 'receptor']) // Cargar las relaciones emisor y receptor
        ->latest('fecha_hora') // Ordenar por fecha y hora descendente
        ->get();

    // Pasar las transacciones Bizum, usuarios y cuentas a la vista
    return view('home.bizums', compact('bizums', 'usuarios', 'cuentasUsuarios'));
}

    public function enviar(Request $request)
{
    \Log::info('Datos recibidos para enviar Bizum:', $request->all());

    $request->validate([
        'usuario_id' => 'required|exists:users,id|different:' . Auth::id(),
        'cuenta_id' => 'required|exists:cuentas_bancarias,id',
        'monto' => 'required|numeric|min:0.01',
    ]);

    // Obtener la cuenta emisora y verificar que pertenece al usuario autenticado
    $cuentaEmisor = CuentaBancaria::where('id', $request->cuenta_id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    // Obtener la cuenta receptora del usuario seleccionado
    $cuentaReceptor = CuentaBancaria::where('user_id', $request->usuario_id)->first();

    if (!$cuentaReceptor) {
        return redirect()->back()->with('error', 'El receptor no tiene una cuenta bancaria asociada.');
    }

    // Verificar que el emisor tenga saldo suficiente
    if ($cuentaEmisor->saldo < $request->monto) {
        return redirect()->back()->with('error', 'No tienes saldo suficiente para realizar el Bizum.');
    }

    // Restar saldo al emisor y sumar al receptor
    $cuentaEmisor->saldo -= $request->monto;
    $cuentaReceptor->saldo += $request->monto;

    $cuentaEmisor->save();
    $cuentaReceptor->save();

    // Crear el Bizum
    Bizum::create([
        'id_emisor' => Auth::id(),
        'id_receptor' => $request->usuario_id,
        'cuenta_emisor' => $cuentaEmisor->num_cuenta,
        'cuenta_receptor' => $cuentaReceptor->num_cuenta,
        'monto' => $request->monto,
        'fecha_hora' => now(),
    ]);

    return redirect()->route('bizums.home')->with('success', 'Bizum enviado correctamente.');
}
     
}

