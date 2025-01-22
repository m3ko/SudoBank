<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripulantesController;
use App\Http\Controllers\ViajesController;
use App\Http\Controllers\MedicosController;
use App\Http\Controllers\RescatadosController;
use App\Http\Controllers\RescatesController;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
//Rutas Tripulantes
Route::get('/tripulantes/añadir', TripulantesController::class .'@create')->middleware('can:crear entidad')->name('tripulantes.create');
Route::post('/tripulantes', [TripulantesController::class, 'store'])->middleware('can:guardar entidad')->name('tripulantes.store');
Route::delete('/tripulantes/{tripulante}', TripulantesController::class .'@destroy')->middleware('can:eliminar entidad')->name('tripulantes.destroy');
Route::put('/tripulantes/{tripulante}', [TripulantesController::class, 'update'])->middleware('can:guardar entidad')->name('tripulantes.update');
Route::get('/tripulantes/{tripulante}/edit', [TripulantesController::class, 'edit'])->middleware('can:editar entidad')->name('tripulantes.edit');
Route::get('/tripulantes/show/{tripulante}', TripulantesController::class . '@show')->middleware('can:ver entidad')->name('tripulantes.show');

//Rutas viajes
Route::get('/viajes/añadir', ViajesController::class .'@create')->middleware('can:crear entidad')->name('viajes.create');
Route::post('/viajes', [ViajesController::class, 'store'])->middleware('can:guardar entidad')->name('viajes.store');
Route::delete('/viajes/{viaje}', ViajesController::class .'@destroy')->middleware('can:eliminar entidad')->name('viajes.destroy');
Route::put('/viajes/{viaje}', [ViajesController::class, 'update'])->middleware('can:guardar entidad')->name('viajes.update');
Route::get('/viajes/{viaje}/edit', [ViajesController::class, 'edit'])->middleware('can:editar entidad')->name('viajes.edit');
Route::get('/viajes/show/{viaje}', ViajesController::class .'@show')->middleware('can:ver entidad')->name('viajes.show');
Route::post('/viajes/{viaje}/add-tripulantes', [ViajesController::class, 'addTripulantes'])->name('viajes.addTripulantes');
Route::post('/viajes/{viaje}/add-medicos', [ViajesController::class, 'addMedicos'])->name('viajes.addMedicos');


//Rutas Medicos
Route::get('/medicos/añadir', MedicosController::class .'@create')->middleware('can:crear entidad')->name('medicos.create');
Route::post('/medicos', [MedicosController::class, 'store'])->middleware('can:guardar entidad')->name('medicos.store');
Route::delete('/medicos/{medico}', MedicosController::class .'@destroy')->middleware('can:eliminar entidad')->name('medicos.destroy');
Route::put('/medicos/{medico}', [MedicosController::class, 'update'])->middleware('can:guardar entidad')->name('medicos.update');
Route::get('/medicos/{medico}/edit', [MedicosController::class, 'edit'])->middleware('can:editar entidad')->name('medicos.edit');
Route::get('/medicos/show/{medico}', MedicosController::class .'@show')->middleware('can:ver entidad')->name('medicos.show');

//Rutas rescatados
Route::get('/rescatados/añadir', RescatadosController::class .'@create')->middleware('can:crear entidad')->name('rescatados.create');
Route::post('/rescatados', [RescatadosController::class, 'store'])->middleware('can:guardar entidad')->name('rescatados.store');
Route::delete('/rescatados/{tripulante}', RescatadosController::class .'@destroy')->middleware('can:eliminar entidad')->name('rescatados.destroy');
Route::put('/rescatados/{tripulante}', [RescatadosController::class, 'update'])->middleware('can:guardar entidad')->name('rescatados.update');
Route::get('/rescatados/{tripulante}/edit', [RescatadosController::class, 'edit'])->middleware('can:editar entidad')->name('rescatados.edit');
Route::get('/rescatados/show/{tripulante}', RescatadosController::class . '@show')->middleware('can:ver entidad')->name('rescatados.show');

//Rutas rescates
Route::get('/rescates/añadir', RescatesController::class .'@create')->middleware('can:crear entidad')->name('rescates.create');
Route::post('/rescates', [RescatesController::class, 'store'])->middleware('can:guardar entidad')->name('rescates.store');
Route::delete('/rescates/{rescate}', RescatesController::class .'@destroy')->middleware('can:eliminar entidad')->name('rescates.destroy');
Route::put('/rescates/{rescate}', [RescatesController::class, 'update'])->middleware('can:guardar entidad')->name('rescates.update');
Route::get('/rescates/{rescate}/edit', [RescatesController::class, 'edit'])->middleware('can:editar entidad')->name('rescates.edit');
Route::get('/rescates/show/{rescate}', RescatesController::class . '@show')->middleware('can:ver entidad')->name('rescates.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
    //Index Protegidos
    
    Route::get('/rescatados', RescatadosController::class .'@index')->middleware('can:ver entidad')->name('rescatados.index');
    Route::get('/tripulantes', TripulantesController::class .'@index')->middleware('can:ver entidad')->name('tripulantes.index');
    Route::get('/viajes', ViajesController::class .'@index')->middleware('can:ver entidad')->name('viajes.index');
    Route::get('/medicos', MedicosController::class .'@index')->middleware('can:ver entidad')->name('medicos.index');
    Route::get('/rescates', RescatesController::class .'@index')->middleware('can:ver entidad')->name('rescates.index');
    //Rutas Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/viajesApi', [App\Http\Controllers\ViajesController::class, 'indexApi']);
Route::get('/viajesApi/{id}', [App\Http\Controllers\ViajesController::class, 'show']);

Route::get('rescatesApi', [RescatesController::class, 'indexApi']);
Route::get('rescatesApi/{id}', [RescatesController::class, 'show']);


Route::get('rescatadosApi', [RescatadosController::class, 'indexApi']);
Route::get('rescatadosApi/{id}', [RescatadosController::class, 'show']);


Route::get('/testApi', function () {
    return response()->json(['message' => 'API funcionando correctamente']);
});



require __DIR__.'/auth.php';
