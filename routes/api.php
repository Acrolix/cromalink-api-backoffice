<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ReaccionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'email'], function () {
    Route::get('verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('resend', [AuthController::class, 'resendEmailVerification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('auth.logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth')->name('auth.refresh');
    Route::get('me', [AuthController::class, 'me'])->middleware('auth')->name('auth.me');
});

Route::group(['prefix' => 'publications'], function () {
    Route::get('/', [PublicationController::class, 'filtrar'])->middleware(['auth', 'verified'])->name('publicaciones.filtrar');
    Route::post('/', [PublicationController::class, 'guardar'])->middleware(['auth', 'verified'])->name('publicaciones.guardar');
    Route::get('/{id}', [PublicationController::class, 'obtener'])->middleware(['auth', 'verified'])->name('publicaciones.obtener');
    Route::put('/{id}', [PublicationController::class, 'actualizar'])->middleware(['auth', 'verified'])->name('publicaciones.actualizar');
    Route::delete('/{id}', [PublicationController::class, 'eliminar'])->middleware(['auth', 'verified'])->name('publicaciones.eliminar');
});

Route::group(['prefix' => 'reacciones'], function () {
    Route::post('/', [ReaccionController::class, 'setLike'])->name('reacciones.setLike');
    Route::delete('/', [ReaccionController::class, 'unsetLike'])->name('reacciones.unsetLike');
});

Route::group(['prefix' => 'comments'], function () {
    Route::get('/{id}', [ComentarioController::class, 'listar'])->name('comentarios.listar');
    Route::post('/', [ComentarioController::class, 'guardar'])->name('comentarios.guardar');
    Route::put('/{id}', [ComentarioController::class, 'actualizar'])->name('comentarios.actualizar');
    Route::delete('/{id}', [ComentarioController::class, 'eliminar'])->name('comentarios.eliminar');
});
