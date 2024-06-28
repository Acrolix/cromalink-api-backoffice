<?php

use App\Http\Controllers\PublicacionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'publicaciones'], function () {
    Route::get('/', [PublicacionController::class, 'filtrar'])->name('publicaciones.filtrar');
    Route::post('/', [PublicacionController::class, 'guardar'])->name('publicaciones.guardar');
    Route::get('/{id}', [PublicacionController::class, 'obtener'])->name('publicaciones.obtener');
    Route::put('/{id}', [PublicacionController::class, 'actualizar'])->name('publicaciones.actualizar');
    Route::delete('/{id}', [PublicacionController::class, 'eliminar'])->name('publicaciones.eliminar');
});