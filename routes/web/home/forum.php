<?php

use Illuminate\Support\Facades\Route;

Route::get(
    'category/{categorySlug}',
    [\App\Http\Controllers\Forum\ThreadController::class, 'categoryIndex']
)->name('category');

Route::post(
    'address/search',
    [\App\Http\Controllers\Forum\ThreadController::class, 'searchByAddress']
)->name('address');
Route::get(
    'address/{addressId}',
    [\App\Http\Controllers\Forum\ThreadController::class, 'addressIndex']
)->name('address');

Route::resource(
    '', \App\Http\Controllers\Forum\ThreadController::class
);

Route::get(
    '{slug}', [\App\Http\Controllers\Forum\ThreadController::class, 'show']
)->name('show');
Route::post(
    '{slug}/comments', [\App\Http\Controllers\Forum\ThreadCommentController::class, 'store']
)->name('comments.store');
