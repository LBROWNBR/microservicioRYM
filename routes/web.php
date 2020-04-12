<?php

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
    return view('welcome');
});

/*
Route::get('/tareas', 'TaskController@index');
Route::put('/tareas/actualizar', 'TaskController@update');
Route::post('/tareas/guardar', 'TaskController@store');
Route::delete('/tareas/borrar/{id}', 'TaskController@destroy');
Route::get('/tareas/buscar', 'TaskController@show');
*/

Route::prefix('api/v1/')->group(function () {

	Route::get('/producto', 'ProductoController@index');
	Route::get('/producto/listar/{item}/{totreg}', 'ProductoController@list');
	Route::post('/producto/guardar', 'ProductoController@store');
	Route::get('/producto/ver/{id}', 'ProductoController@show');
	Route::put('/producto/actualizar', 'ProductoController@update');
	Route::delete('/producto/borrar/{id}', 'ProductoController@destroy');

});