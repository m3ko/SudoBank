<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PagoPendiente;
use App\Models\Deuda;
use App\Models\CuentaBancaria;

class NotificacionesController extends Controller
{
    public function notificacionesHome()
    {
        $user = Auth::user();

        // Obtener las cuentas bancarias del usuario
        $cuentas = CuentaBancaria::where('user_id', $user->id)->pluck('id');

        // Buscar deudas enlazadas a las cuentas del usuario
        $deudas = Deuda::whereIn('cuenta_id', $cuentas)->get();

        // Buscar pagos pendientes enlazados a las cuentas del usuario
        $pagosPendientes = PagoPendiente::whereIn('cuenta_id', $cuentas)->get();

        return view('home.notificaciones', compact('deudas', 'pagosPendientes'));   
    }
}