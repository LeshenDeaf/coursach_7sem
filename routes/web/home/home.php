<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index'])->name('index');

Route::resource(
    'forms', \App\Http\Controllers\FormController::class
);
Route::resource(
    'fields', \App\Http\Controllers\FieldController::class
);

//Route::middleware('auth')->post(
//    '/es_auth', [\App\Http\Controllers\ESPlus\ESPlusTokenController::class, 'store']
//)->name('es-auth');

Route::group([
    'prefix' => 'es_plus',
    'as' => 'es_plus',
    'middleware' => ['cors']
], function () {
     Route::post('auth/login', [\App\Http\Controllers\ESPlus\ESPlusTokenController::class, 'login']);
     Route::post('me', [\App\Http\Controllers\ESPlus\MainNumberController::class, 'me']);
     Route::get(
         'refresh_accruals',
         [\App\Http\Controllers\ESPlus\AccrualsController::class, 'refresh']
     );
});

Route::group([
    'prefix' => 'answers',
    'as' => 'answers.',
], __DIR__ . '/answers.php');

Route::group([
    'prefix' => 'forum',
    'as' => 'forum.',
], __DIR__ . '/forum.php');
