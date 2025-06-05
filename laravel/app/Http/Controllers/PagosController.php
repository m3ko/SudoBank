<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PagoPendiente;
use App\Models\CuentaBancaria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Bizum;
use App\Models\Tarjeta;
use App\Models\TransaccionBancaria;
use App\Models\Deuda;

class PagosController extends Controller
{
    public function index()
    {
        // Obtener cuentas bancarias del usuario autenticado
        $cuentasUsuarios = CuentaBancaria::where('user_id', Auth::id())->get();

        return view('home.pagos',compact('cuentasUsuarios') ); // Cargar la vista pagos.blade.php
    }
}