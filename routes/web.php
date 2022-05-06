<?php

use App\Http\Controllers\AddressController;
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
    ], __DIR__ . '/web/home/home.php');
});

Route::middleware(['cors'])->group(function () {
    Route::post('/kladr-api', [AddressController::class, 'getAddresses'])->name('kladr-api');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
