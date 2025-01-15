<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripulantesController;
use App\Http\Controllers\ViajesController;




//Route::store('/tripulantes', TripulantesController::class .'@store')->name('tripulante.store');

Route::delete('/tripulantes/{tripulante}', TripulantesController::class .'@destroy')->name('tripulante.destroy');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tripulantes', TripulantesController::class .'@index')->name('tripulantes.index');
Route::get('/tripulantes/añadir', TripulantesController::class .'@create')->name('tripulantes.create');
Route::post('/tripulantes', [TripulantesController::class, 'store'])->name('tripulantes.store');
Route::delete('/tripulantes/{tripulante}', TripulantesController::class .'@destroy')->name('tripulantes.destroy');
Route::put('/tripulante/{tripulante}', [TripulanteController::class, 'update'])->name('tripulantes.update');

Route::get('/viajes', ViajesController::class .'@index')->name('viajes.index');
Route::get('/viajes/añadir', ViajesController::class .'@create')->name('viajes.create');
Route::post('/viajes', [ViajesController::class, 'store'])->name('viajes.store');
Route::delete('/viajes/{viaje}', ViajesController::class .'@destroy')->name('viajes.destroy');
Route::put('/viaje/{viaje}', [ViajesController::class, 'update'])->name('viajes.update');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
