<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware(
//    ['auth', 'is_admin']
//)->resource('roles', \App\Http\Controllers\RoleController::class);

Route::resource(
    'roles',
    \App\Http\Controllers\RoleController::class
);
//Route::middleware(
//    'auth:sanctum'
//)->resource(
//    'fields',
//    \App\Http\Controllers\FieldController::class
//);
