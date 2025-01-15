<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripulantesController;
use App\Http\Controllers\MedicosController;

Route::get('/', function () {
    return view('welcome');
});

//Rutas Tripulantes
Route::get('/tripulantes', TripulantesController::class .'@index')->name('tripulantes.index');
Route::get('/tripulantes/añadir', TripulantesController::class .'@create')->name('tripulantes.create');
Route::post('/tripulantes', [TripulantesController::class, 'store'])->name('tripulantes.store');
Route::delete('/tripulantes/{tripulante}', TripulantesController::class .'@destroy')->name('tripulantes.destroy');
// Route::delete('/tripulantes/{tripulante}', [TripulantesController::class, 'destroy'])->name('tripulantes.destroy');

Route::put('/tripulante/{tripulante}', [TripulantesController::class, 'update'])->name('tripulantes.update');
Route::get('/tripulantes/{tripulante}/edit', [TripulantesController::class, 'edit'])->name('tripulantes.edit');

//Rutas Medicos
Route::get('/medicos', MedicosController::class .'@index')->name('medicos.index');
Route::get('/medicos/añadir', MedicosController::class .'@create')->name('medicos.create');
Route::post('/medicos', [MedicosController::class, 'store'])->name('medicos.store');
Route::delete('/medicos/{medico}', MedicosController::class .'@destroy')->name('medicos.destroy');
// Route::delete('/medicos/{medico}', [MedicosController::class, 'destroy'])->name('medicos.destroy');

Route::put('/medicos/{medico}', [MedicosController::class, '@update'])->name('medicos.update');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
