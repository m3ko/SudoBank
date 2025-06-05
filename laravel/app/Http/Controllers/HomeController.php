<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CuentaBancaria;
use App\Models\TransaccionBancaria;
use App\Models\Tarjeta;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    public function index()
    {
        return view('home.index'); // Carga la vista resources/views/home/index.blade.php
    }

    public function infoHome()
    {
        $user = Auth::user(); // Usuario autenticado
    
        // Obtener las cuentas bancarias asociadas al usuario autenticado
        $cuentas = CuentaBancaria::where('user_id', $user->id)->pluck('id');
    
        // Obtener las transacciones asociadas a las cuentas bancarias del usuario
        $transfers = TransaccionBancaria::whereIn('cuenta_id', $cuentas)
            ->latest('fecha') // Ordenar por fecha descendente
            ->get();
    
        // Obtener las tarjetas asociadas a las cuentas bancarias del usuario
        $tarjetas = Tarjeta::whereIn('cuenta_bancaria_id', $cuentas)
            ->with('cuentaBancaria') // Cargar la relación con las cuentas bancarias
            ->get();
    
        // Pasar ambas colecciones a la vista
        return view('home.index', compact('transfers', 'tarjetas'));
    }
}
