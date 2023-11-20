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

Route::post('/achat/create', 'AchatController@store');
Route::get('/achat/edit/{id}', 'AchatController@edit');
Route::post('/achat/update/{id}', 'AchatController@update');
Route::delete('/achat/delete/{id}', 'AchatController@delete');
Route::get('/achat/all', 'AchatController@index');

Route::post('/ticket/create', 'TicketController@store');
Route::get('/ticket/edit/{id}', 'TicketController@edit');
Route::post('/ticket/update/{id}', 'TicketController@update');
Route::delete('/ticket/delete/{n_serie}', 'TicketController@delete');
Route::post('/ticket/check/{id}', 'TicketController@check');
Route::get('/ticket/all', 'TicketController@index');

Route::post('/client/create', 'ClientController@store');
Route::get('/client/edit/{id}', 'ClientController@edit');
Route::post('/client/update/{id}', 'ClientController@update');
Route::delete('/client/delete/{id}', 'ClientController@delete');
Route::get('/client/all', 'ClientController@index');

