<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripulantesController;
use App\Http\Controllers\ViajesController;
use App\Http\Controllers\MedicosController;
use App\Http\Controllers\RescatadosController;




//Route::store('/tripulantes', TripulantesController::class .'@store')->name('tripulante.store');


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
//Rutas Tripulantes
Route::get('/tripulantes', TripulantesController::class .'@index')->middleware('can:ver entidad')->name('tripulantes.index');
Route::get('/tripulantes/añadir', TripulantesController::class .'@create')->middleware('can:crear entidad')->name('tripulantes.create');
Route::post('/tripulantes', [TripulantesController::class, 'store'])->name('tripulantes.store');
Route::delete('/tripulantes/{tripulante}', TripulantesController::class .'@destroy')->middleware('can:eliminar entidad')->name('tripulantes.destroy');
Route::delete('/tripulantes/{tripulante}', TripulantesController::class .'@destroy')->middleware('can:eliminar entidad')->name('tripulantes.destroy');
// Route::delete('/tripulantes/{tripulante}', [TripulantesController::class, 'destroy'])->name('tripulantes.destroy');
Route::put('/tripulantes/{tripulante}', [TripulantesController::class, 'update'])->middleware('can:guardar entidad')->name('tripulantes.update');
Route::get('/tripulantes/{tripulante}/edit', [TripulantesController::class, 'edit'])->middleware('can:editar entidad')->name('tripulantes.edit');

Route::get('/tripulantes/show/{tripulante}', TripulantesController::class . '@show')->name('tripulantes.show');

//Rutas viajes
Route::get('/viajes/añadir', ViajesController::class .'@create')->name('viajes.create');
Route::post('/viajes', [ViajesController::class, 'store'])->name('viajes.store');
Route::delete('/viajes/{viaje}', ViajesController::class .'@destroy')->name('viajes.destroy');
Route::put('/viajes/{viaje}', [ViajesController::class, 'update'])->name('viajes.update');
Route::get('/viajes/{viaje}/edit', [ViajesController::class, 'edit'])->name('viajes.edit');
Route::get('/viajes/show/{viaje}', ViajesController::class .'@show')->name('viajes.show');

//Rutas Medicos
Route::get('/medicos/añadir', MedicosController::class .'@create')->name('medicos.create');
Route::post('/medicos', [MedicosController::class, 'store'])->name('medicos.store');
Route::delete('/medicos/{medico}', MedicosController::class .'@destroy')->name('medicos.destroy');
// Route::delete('/medicos/{medico}', [MedicosController::class, 'destroy'])->name('medicos.destroy');

Route::put('/medicos/{medico}', [MedicosController::class, 'update'])->name('medicos.update');
Route::get('/medicos/{medico}/edit', [MedicosController::class, 'edit'])->name('medicos.edit');
Route::get('/medicos/show/{medico}', MedicosController::class .'@show')->name('medicos.show');

//Rutas rescatados
Route::get('/rescatados/añadir', RescatadosController::class .'@create')->middleware('can:crear entidad')->name('rescatados.create');
Route::post('/rescatados', [RescatadosController::class, 'store'])->name('rescatados.store');
Route::delete('/rescatados/{tripulante}', RescatadosController::class .'@destroy')->middleware('can:eliminar entidad')->name('rescatados.destroy');
Route::put('/rescatados/{tripulante}', [RescatadosController::class, 'update'])->middleware('can:guardar entidad')->name('rescatados.update');
Route::get('/rescatados/{tripulante}/edit', [RescatadosController::class, 'edit'])->middleware('can:editar entidad')->name('rescatados.edit');
Route::get('/rescatados/show/{tripulante}', RescatadosController::class . '@show')->name('rescatados.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/rescatados', RescatadosController::class .'@index')->middleware('can:ver entidad')->name('rescatados.index');

    Route::get('/tripulantes', TripulantesController::class .'@index')->middleware('can:ver entidad')->name('tripulantes.index');
    Route::get('/viajes', ViajesController::class .'@index')->name('viajes.index');
    Route::get('/medicos', MedicosController::class .'@index')->name('medicos.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
