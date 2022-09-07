<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);

    Route::group(['prefix' => 'users'], function() {
        Route::get('/', 'UsersController@index')->name('users.index');
        Route::get('/create', 'UsersController@create')->name('users.create');
        Route::post('/create', 'UsersController@store')->name('users.store');
        Route::get('/{user}/show', 'UsersController@show')->name('users.show');
        Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
        Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
        Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
    });

    Route::group(['prefix' => 'file_uploads'], function() {
        Route::get('/', 'FileUploadsController@index')->name('file_uploads.index');
        Route::get('/create', 'FileUploadsController@create')->name('file_uploads.create');
        Route::post('/create', 'FileUploadsController@store')->name('file_uploads.store');
        Route::get('/{post}/show', 'FileUploadsController@show')->name('file_uploads.show');
        Route::get('/{post}/edit', 'FileUploadsController@edit')->name('file_uploads.edit');
        Route::patch('/{post}/update', 'FileUploadsController@update')->name('file_uploads.update');
        Route::delete('/{post}/delete', 'FileUploadsController@destroy')->name('file_uploads.destroy');
    });
});
