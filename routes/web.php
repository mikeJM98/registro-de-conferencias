<?php

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
Route::get('reniec/dni/{dni}','ApiController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/autocomplete', 'AutocompleteController@search');
Route::post('/registrar_asistentes', 'AsistentesController@registra');
Route::get('/consulta_asistentes', 'AsistentesController@show');
Route::get('/consulta_asistente', 'AsistentesController@buscar_asistente');
Route::get('/virifica_dni','AsistentesController@virifica_dni');

Route::get('/consulta_dni', 'ApiController@buscarDni');
Route::get('/empresas_search','EmpresasController@search');
Route::get('/consulta_conferencias', 'ConferenciasController@show');
Route::post('/nueva_empresa','EmpresasController@nueva_empresa');

Route::get('exportar','AsistentesExportController@index');

