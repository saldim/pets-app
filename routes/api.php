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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('pet', \App\Http\Controllers\PetController::class);
Route::apiResource('owner', \App\Http\Controllers\OwnerController::class);

Route::get('owner/find/{phone}', '\App\Http\Controllers\OwnerController@find');

//Route::get('/pets', 'App\Http\Controllers\PetController@index');
//Route::get('/pets/{id}', 'App\Http\Controllers\PetController@view');
//Route::post('/pets/store', 'App\Http\Controllers\PetController@store');
