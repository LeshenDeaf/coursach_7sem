<?php

use Illuminate\Support\Facades\Route;

Route::resource(
    'forms', \App\Http\Controllers\FormController::class
);
Route::resource(
    'fields', \App\Http\Controllers\FieldController::class
);

Route::group([
    'prefix' => 'answers',
    'as' => 'answers.',
], __DIR__ . '/answers.php');

Route::group([
    'prefix' => 'forum',
    'as' => 'forum.',
], __DIR__ . '/forum.php');
