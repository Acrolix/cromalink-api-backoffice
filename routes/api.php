<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ReaccionController;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

Passport::routes();

Route::get('/emailVerifySuccess', function () {
    return redirect()->to('/');
})->name('emailVerifySuccess');

Route::group(['prefix' => 'email'], function () {
    Route::get('verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('resend', [AuthController::class, 'resendEmailVerification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('auth.logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth')->name('auth.refresh');
    Route::get('validate', [AuthController::class, 'validateToken'])->middleware('auth')->name('auth.validate');
});

Route::group(['prefix' => 'publications'], function () {
    Route::get('/', [PublicationController::class, 'index'])->middleware(['auth', 'verified'])->name('publication.index');
    Route::post('/', [PublicationController::class, 'store'])->middleware(['auth', 'verified'])->name('publication.store');
    Route::get('/{id}', [PublicationController::class, 'show'])->middleware(['auth', 'verified'])->name('publication.show');
    Route::put('/{id}', [PublicationController::class, 'update'])->middleware(['auth', 'verified'])->name('publication.update');
    Route::delete('/{id}', [PublicationController::class, 'destroy'])->middleware(['auth', 'verified'])->name('publication.destroy');
});

Route::group(['prefix' => 'reacciones'], function () {
    Route::post('/', [ReaccionController::class, 'setLike'])->name('reacciones.setLike');
    Route::delete('/', [ReaccionController::class, 'unsetLike'])->name('reacciones.unsetLike');
});

Route::group(['prefix' => 'comments'], function () {
    Route::get('/{id}', [CommentController::class, 'listar'])->name('comentarios.listar');
    Route::post('/', [CommentController::class, 'guardar'])->name('comentarios.guardar');
    Route::put('/{id}', [CommentController::class, 'actualizar'])->name('comentarios.actualizar');
    Route::delete('/{id}', [CommentController::class, 'eliminar'])->name('comentarios.eliminar');
});
