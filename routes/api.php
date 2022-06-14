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

/** Listado de API */

Route::get('/establecimientos', 'APIController@index')->name('establecimientos.index');

Route::get('/establecimientos/{establecimiento}', 'APIController@show')->name('establecimientos.shpw');



Route::get('/categorias', 'APIController@categorias')->name('categorias');
Route::get('/categorias/{categoria}', 'APIController@categoria')->name('categoria');