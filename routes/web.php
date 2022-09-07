<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);

    Route::group(['prefix' => 'users'], function() {
        Route::get('/', [App\Http\Controllers\UsersController::class, 'index'])->name('users.index');
        Route::get('/create', [App\Http\Controllers\UsersController::class, 'create'])->name('users.create');
        Route::post('/create', [App\Http\Controllers\UsersController::class, 'store'])->name('users.store');
        // Route::get('/{user}/show', [App\Http\Controllers\UsersController::class, 'show'])->name('users.show');
        Route::get('/{user}/edit', [App\Http\Controllers\UsersController::class, 'edit'])->name('users.edit');
        Route::patch('/{user}/update', [App\Http\Controllers\UsersController::class, 'update'])->name('users.update');
        Route::delete('/{user}/delete', [App\Http\Controllers\UsersController::class, 'destroy'])->name('users.destroy');
    });

    // Route::group(['prefix' => 'file_uploads'], function() {
    //     Route::get('/', 'FileUploadsController@index')->name('file_uploads.index');
    //     Route::get('/create', 'FileUploadsController@create')->name('file_uploads.create');
    //     Route::post('/create', 'FileUploadsController@store')->name('file_uploads.store');
    //     Route::get('/{file_upload}/show', 'FileUploadsController@show')->name('file_uploads.show');
    //     Route::get('/{file_upload}/edit', 'FileUploadsController@edit')->name('file_uploads.edit');
    //     Route::patch('/{file_upload}/update', 'FileUploadsController@update')->name('file_uploads.update');
    //     Route::delete('/{file_upload}/delete', 'FileUploadsController@destroy')->name('file_uploads.destroy');
    // });
});
