<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UserRolesController;
use App\Http\Controllers\FileUploadsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::resource('permissions', PermissionsController::class);

    Route::group(['prefix' => 'users'], function() {
        Route::get('/', [UsersController::class, 'index'])->name('users.index');
        Route::get('/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('/create', [UsersController::class, 'store'])->name('users.store');
        // Route::get('/{user}/show', [UsersController::class, 'show'])->name('users.show');
        Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::patch('/{user}/update', [UsersController::class, 'update'])->name('users.update');
        Route::delete('/{user}/delete', [UsersController::class, 'destroy'])->name('users.destroy');
    });

    Route::group(['prefix' => 'roles'], function() {
        Route::get('/', [UserRolesController::class, 'index'])->name('roles.index');
        Route::get('/create', [UserRolesController::class, 'create'])->name('roles.create');
        Route::post('/create', [UserRolesController::class, 'store'])->name('roles.store');
        // Route::get('/{user}/show', [UserRolesController::class, 'show'])->name('roles.show');
        Route::get('/{role}/edit', [UserRolesController::class, 'edit'])->name('roles.edit');
        Route::patch('/{role}/update', [UserRolesController::class, 'update'])->name('roles.update');
        Route::delete('/{role}/delete', [UserRolesController::class, 'destroy'])->name('roles.destroy');
    });

    Route::group(['prefix' => 'file_uploads'], function() {
        Route::get('/', [FileUploadsController::class, 'index'])->name('file_uploads.index');
        Route::get('/create', [FileUploadsController::class, 'create'])->name('file_uploads.create');
        Route::post('/create', [FileUploadsController::class, 'store'])->name('file_uploads.store');
        // Route::get('/{user}/show', [FileUploadsController::class, 'show'])->name('file_uploads.show');
        Route::get('/{file_upload}/edit', [FileUploadsController::class, 'edit'])->name('file_uploads.edit');
        Route::patch('/{file_upload}/update', [FileUploadsController::class, 'update'])->name('file_uploads.update');
        Route::delete('/{file_upload}/delete', [FileUploadsController::class, 'destroy'])->name('file_uploads.destroy');
    });
});
