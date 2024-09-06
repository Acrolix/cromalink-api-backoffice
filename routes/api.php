<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\ReaccionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('auth.logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth')->name('auth.refresh');
    Route::get('me', [AuthController::class, 'me'])->middleware('auth')->name('auth.me');
});

Route::group(['prefix' => 'publicaciones'], function () {
    Route::get('/', [PublicacionController::class, 'filtrar'])->name('publicaciones.filtrar');
    Route::post('/', [PublicacionController::class, 'guardar'])->name('publicaciones.guardar');
    Route::get('/{id}', [PublicacionController::class, 'obtener'])->name('publicaciones.obtener');
    Route::put('/{id}', [PublicacionController::class, 'actualizar'])->name('publicaciones.actualizar');
    Route::delete('/{id}', [PublicacionController::class, 'eliminar'])->name('publicaciones.eliminar');
});

Route::group(['prefix' => 'reacciones'], function () {
    Route::post('/', [ReaccionController::class, 'setLike'])->name('reacciones.setLike');
    Route::delete('/', [ReaccionController::class, 'unsetLike'])->name('reacciones.unsetLike');
});

Route::group(['prefix' => 'comentarios'], function () {
    Route::get('/{id}', [ComentarioController::class, 'listar'])->name('comentarios.listar');
    Route::post('/', [ComentarioController::class, 'guardar'])->name('comentarios.guardar');
    Route::put('/{id}', [ComentarioController::class, 'actualizar'])->name('comentarios.actualizar');
    Route::delete('/{id}', [ComentarioController::class, 'eliminar'])->name('comentarios.eliminar');
});
