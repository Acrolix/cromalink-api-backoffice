<?php

use App\Http\Controllers\PublicacionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/posts', [PublicacionController::class, 'index'])->name('posts.index');
Route::post('/posts', [PublicacionController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}', [PublicacionController::class, 'show'])->name('posts.show');
Route::put('/posts/{id}', [PublicacionController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PublicacionController::class, 'destroy'])->name('posts.destroy');