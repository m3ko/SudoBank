<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BizumController;
use App\Http\Controllers\TarjetaController;
use App\Http\Controllers\CuentaBancariaController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Rutas usuarios
    Route::get('/usuarios/añadir', [UserController::class, 'create'])->middleware('can:crear entidad')->name('usuarios.create');
    Route::post('/usuarios', [UserController::class, 'store'])->middleware('can:guardar entidad')->name('usuarios.store');
    Route::delete('/usuarios/{usuario}', [UserController::class, 'destroy'])->middleware('can:eliminar entidad')->name('usuarios.destroy');
    Route::put('/usuarios/{usuario}', [UserController::class, 'update'])->middleware('can:guardar entidad')->name('usuarios.update');
    Route::get('/usuarios/{usuario}/edit', [UserController::class, 'edit'])->middleware('can:editar entidad')->name('usuarios.edit');
    Route::get('/usuarios/show/{usuario}', [UserController::class, 'show'])->middleware('can:ver entidad')->name('usuarios.show');
    Route::get('/usuarios', [UserController::class, 'index'])->middleware('can:ver entidad')->name('usuarios.index');

    // Rutas cuentas
    Route::get('/cuentas/añadir', [CuentaBancariaController::class, 'create'])->middleware('can:crear entidad')->name('cuentas.create');
    Route::post('/cuentas', [CuentaBancariaController::class, 'store'])->middleware('can:guardar entidad')->name('cuentas.store');
    Route::delete('/cuentas/{cuenta}', [CuentaBancariaController::class, 'destroy'])->middleware('can:eliminar entidad')->name('cuentas.destroy');
    Route::put('/cuentas/{cuenta}', [CuentaBancariaController::class, 'update'])->middleware('can:guardar entidad')->name('cuentas.update');
    Route::get('/cuentas/{cuenta}/edit', [CuentaBancariaController::class, 'edit'])->middleware('can:editar entidad')->name('cuentas.edit');
    Route::get('/cuentas/show/{cuenta}', [CuentaBancariaController::class, 'show'])->middleware('can:ver entidad')->name('cuentas.show');
    Route::get('/cuentas', [CuentaBancariaController::class, 'index'])->middleware('can:ver entidad')->name('cuentas.index');

    // Rutas tarjetas
    Route::get('/tarjetas/añadir', [TarjetaController::class, 'create'])->middleware('can:crear entidad')->name('tarjetas.create');
    Route::post('/tarjetas', [TarjetaController::class, 'store'])->middleware('can:guardar entidad')->name('tarjetas.store');
    Route::delete('/tarjetas/{tarjeta}', [TarjetaController::class, 'destroy'])->middleware('can:eliminar entidad')->name('tarjetas.destroy');
    Route::put('/tarjetas/{tarjeta}', [TarjetaController::class, 'update'])->middleware('can:guardar entidad')->name('tarjetas.update');
    Route::get('/tarjetas/{tarjeta}/edit', [TarjetaController::class, 'edit'])->middleware('can:editar entidad')->name('tarjetas.edit');
    Route::get('/tarjetas/show/{tarjeta}', [TarjetaController::class, 'show'])->middleware('can:ver entidad')->name('tarjetas.show');
    Route::get('/tarjetas', [TarjetaController::class, 'index'])->middleware('can:ver entidad')->name('tarjetas.index');

    // Rutas bizum
    Route::get('/bizums/añadir', [BizumController::class, 'create'])->middleware('can:crear entidad')->name('bizums.create');
    Route::post('/bizums', [BizumController::class, 'store'])->middleware('can:guardar entidad')->name('bizums.store');
    Route::delete('/bizums/{bizum}', [BizumController::class, 'destroy'])->middleware('can:eliminar entidad')->name('bizums.destroy');
    Route::put('/bizums/{bizum}', [BizumController::class, 'update'])->middleware('can:guardar entidad')->name('bizums.update');
    Route::get('/bizums/{bizum}/edit', [BizumController::class, 'edit'])->middleware('can:editar entidad')->name('bizums.edit');
    Route::get('/bizums/show/{bizum}', [BizumController::class, 'show'])->middleware('can:ver entidad')->name('bizums.show');
    Route::get('/bizums', [BizumController::class, 'index'])->middleware('can:ver entidad')->name('bizums.index');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Test API
    Route::get('/testApi', function () {
        return response()->json(['message' => 'API funcionando correctamente']);
    });

    // API Usuarios
    Route::get('/usuariosApi', [UserController::class, 'indexApi']);
    Route::get('/usuariosApi/{id}', [UserController::class, 'showApi']);

    // API Cuentas
    Route::get('/cuentasApi', [CuentaBancariaController::class, 'indexApi']);
    Route::get('/cuentasApi/{id}', [CuentaBancariaController::class, 'showApi']);

    // API Tarjetas
    Route::get('/tarjetasApi', [TarjetaController::class, 'indexApi']);
    Route::get('/tarjetasApi/{id}', [TarjetaController::class, 'showApi']);

    // API Bizums
    Route::get('/bizumsApi', [BizumController::class, 'indexApi']);
    Route::get('/bizumsApi/{id}', [BizumController::class, 'showApi']);
});

// Importa rutas de autenticación (login, registro, etc.)
require __DIR__.'/auth.php';
