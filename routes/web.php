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
    return view('welcome', [
        'users' => \App\Models\User::take(1)->get(),
        'roles' => \App\Models\Role::take(1)->get(),
    ]);
});

Route::group(['middleware' => 'auth'], function () {
    Route::group([
        'prefix' => 'admin',
        'middleware' => 'is_admin',
        'as' => 'admin.',
    ], function () {
        Route::resource(
            'users', \App\Http\Controllers\UserController::class
        );
    });

    Route::group([
        'prefix' => 'home',
        'as' => 'home.',
    ], function () {
        Route::resource(
            'forms', \App\Http\Controllers\FormController::class
        );
        Route::resource(
            'fields', \App\Http\Controllers\FieldController::class
        );
    });
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
