<?php

use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\ReaccionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'publicaciones'], function () {
    Route::get('/', [PublicacionController::class, 'filtrar'])->name('publicaciones.filtrar');
    Route::post('/', [PublicacionController::class, 'guardar'])->name('publicaciones.guardar');
    Route::get('/{id}', [PublicacionController::class, 'obtener'])->name('publicaciones.obtener');
    Route::put('/{id}', [PublicacionController::class, 'actualizar'])->name('publicaciones.actualizar');
    Route::delete('/{id}', [PublicacionController::class, 'eliminar'])->name('publicaciones.eliminar');
});

Route::group(['prefix' => 'reacciones'], function () {
    Route::post('/', [ReaccionController::class, 'setLike'])->name('reacciones.setLike');
    Route::delete('/{id}', [ReaccionController::class, 'unsetLike'])->name('reacciones.unsetLike');
});