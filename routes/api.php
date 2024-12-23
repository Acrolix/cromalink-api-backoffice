<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

Passport::routes();

Route::get('/emailVerifySuccess', function () {
    return redirect()->to('/');
})->name('emailVerifySuccess');

Route::group(['prefix' => 'email'], function () {
    Route::get('verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware(['oauth', 'signed'])->name('verification.verify');
    Route::post('resend', [AuthController::class, 'resendEmailVerification'])->middleware(['oauth', 'throttle:6,1'])->name('verification.send');
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('logout', [AuthController::class, 'logout'])->middleware('oauth')->name('auth.logout');
    Route::get('me', [AuthController::class, 'me'])->middleware('oauth')->name('auth.me');
    Route::get('validate', [AuthController::class, 'validateToken'])->middleware('oauth')->name('auth.validate');
});

Route::group(['prefix' => 'publications'], function () {
    Route::get('/', [PublicationController::class, 'index'])->middleware(['oauth', 'verified'])->name('publication.index');
    Route::post('/', [PublicationController::class, 'store'])->middleware(['oauth', 'verified'])->name('publication.store');
    Route::get('/{id}', [PublicationController::class, 'show'])->middleware(['oauth', 'verified'])->name('publication.show');
    Route::put('/{id}', [PublicationController::class, 'update'])->middleware(['oauth', 'verified'])->name('publication.update');
    Route::delete('/{id}', [PublicationController::class, 'destroy'])->middleware(['oauth', 'verified'])->name('publication.destroy');
});

Route::group(['prefix'=> 'comments'], function () {
    Route::get('{id}', [PublicationController::class, 'index'])->middleware(['oauth'])->name('comment.show');
});

Route::group(['prefix' => 'reaction'], function () {
    Route::post('/{id}', [ReactionController::class, 'toggleLike'])->name('reaction.toggleLike');
});

Route::group(['prefix' => 'admin'], function () {
    Route::middleware('oauth')->get('/', [UserAdminController::class, 'index'])->name('admin.index');
    Route::middleware('oauth')->get('/{id}', [UserAdminController::class, 'show'])->name('admin.show');
    Route::middleware('oauth')->post('/', [UserAdminController::class, 'store'])->name('admin.store');
    Route::middleware('oauth')->put('/', [UserAdminController::class, 'update'])->name('admin.update');
    Route::middleware('oauth')->delete('/{id}', [UserAdminController::class, 'destroy'])->name('admin.destroy');
});

Route::group(['prefix' => 'users'], function () {
    Route::middleware('oauth')->get('/', [UserProfileController::class, 'index'])->name('users.index');
    Route::middleware('oauth')->get('/{id}', [UserProfileController::class, 'show'])->name('users.show');
    Route::middleware('oauth')->post('/', [UserProfileController::class, 'store'])->name('users.store');
    Route::middleware('oauth')->put('/', [UserProfileController::class, 'update'])->name('users.update');
    Route::middleware('oauth')->delete('/{id}', [UserProfileController::class, 'destroy'])->name('users.destroy');
});

Route::group(['prefix' => 'media'], function () {
    Route::get('avatars/{filename}', function ($filename) {
        $path = storage_path("app/public/avatars/$filename");

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    });
});
