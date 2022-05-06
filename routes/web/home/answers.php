<?php

use Illuminate\Support\Facades\Route;

Route::get(
    'create/{formId}', [\App\Http\Controllers\AnswerController::class, 'createFromForm']
)->name('fill_form');
Route::post(
    'create/{formId}', [\App\Http\Controllers\AnswerController::class, 'storeFromForm']
)->name('store_results');
Route::resource(
    '', \App\Http\Controllers\AnswerController::class
);
