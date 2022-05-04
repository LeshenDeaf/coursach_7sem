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
    ], function () {
        Route::resource(
            'forms', \App\Http\Controllers\FormController::class
        );
        Route::resource(
            'fields', \App\Http\Controllers\FieldController::class
        );

        Route::get(
            'answers/create/{formId}', [\App\Http\Controllers\AnswerController::class, 'createFromForm']
        )->name('answers.fill_form');
        Route::post(
            'answers/create/{formId}', [\App\Http\Controllers\AnswerController::class, 'storeFromForm']
        )->name('answers.store_results');
        Route::resource(
            'answers', \App\Http\Controllers\AnswerController::class
        );

        Route::get(
            'forum/category/{categorySlug}',
            [\App\Http\Controllers\Forum\ThreadController::class, 'categoryIndex']
        )->name('forum.category');
        Route::get(
            'forum/address/{addressOd}',
            [\App\Http\Controllers\Forum\ThreadController::class, 'addressIndex']
        )->name('forum.address');
        Route::resource(
            'forum', \App\Http\Controllers\Forum\ThreadController::class
        );
        Route::get(
            '/forum/{slug}', [\App\Http\Controllers\Forum\ThreadController::class, 'show']
        )->name('forum.show');
        Route::post(
            '/forum/{slug}/comments', [\App\Http\Controllers\Forum\ThreadCommentController::class, 'store']
        )->name('forum.comments.store');
    });
});

Route::middleware(['cors'])->group(function () {
    Route::post('/kladr-api', [AddressController::class, 'getAddresses'])->name('kladr-api');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
