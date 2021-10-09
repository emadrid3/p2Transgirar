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

//Routes authenticate
Auth::routes();

//Routes app
Route::get('/', function () {return view('auth.login');});

//PANTALLA PRINCIPAL
Route::get('/home', 'HomeController@index')->middleware('auth');

//PANTALLA USUARIOS
Route::get('/usuarios', 'UsuarioController@index')->middleware('auth');
Route::get('/usuarios-manage', 'UsuarioController@manageUsers')->middleware('auth');
Route::get('/usuarios-manage/{id}', 'UsuarioController@editUsers')->middleware('auth');

//PANTALLA VEHICULOS
Route::get('/vehiculos', 'VehiculoController@index')->middleware('auth');
Route::get('/vehiculos-manage', 'VehiculoController@manageVehicles')->middleware('auth');
Route::get('/vehiculos-manage/{id}', 'VehiculoController@editVehicles')->middleware('auth');

//PANTALLA CONDUCTORES
Route::get('/conductores', 'ConductorController@index')->middleware('auth');
Route::get('/conductores-manage', 'ConductorController@manageDrivers')->middleware('auth');
Route::get('/conductores-manage/{id}', 'ConductorController@editDrivers')->middleware('auth');



//Routes API

//USUARIOS

Route::post('/api/usuario', 'UsuarioController@create')->middleware('auth');
Route::patch('/api/usuario', 'UsuarioController@update')->middleware('auth');
Route::delete('/api/usuario', 'UsuarioController@delete')->middleware('auth');
Route::get('/api/usuarios', 'UsuarioController@list')->middleware('auth');
Route::get('/api/get-roles', 'UsuarioController@getRoles')->middleware('auth');
Route::get('/api/usuarios-search', 'UsuarioController@searchByParams')->middleware('auth');
Route::get('/api/usuarios/search', 'UsuarioController@search')->middleware('auth');

//CONDUCTORES

Route::post('/api/conductores', 'ConductorController@create')->middleware('auth');
Route::patch('/api/conductores', 'ConductorController@update')->middleware('auth');
Route::delete('/api/conductores', 'ConductorController@delete')->middleware('auth');
Route::get('/api/conductores', 'ConductorController@list')->middleware('auth');
Route::get('/api/conductores-search', 'ConductorController@searchByParams')->middleware('auth');
Route::get('/api/conductores/search', 'ConductorController@search')->middleware('auth');


//CLIENTES

Route::post('/api/cliente', 'ClienteController@create')->middleware('auth');
Route::patch('/api/cliente', 'ClienteController@update')->middleware('auth');
Route::delete('/api/cliente', 'ClienteController@delete')->middleware('auth');
Route::get('/api/cliente', 'ClienteController@list')->middleware('auth');
Route::get('/api/cliente-search', 'ClienteController@searchByParams')->middleware('auth');
Route::get('/api/cliente/search', 'ClienteController@search')->middleware('auth');


//VEHICULO
Route::post('/api/vehiculos', 'VehiculoController@create')->middleware('auth');
Route::patch('/api/vehiculos', 'VehiculoController@update')->middleware('auth');
Route::delete('/api/vehiculos', 'VehiculoController@delete')->middleware('auth');
Route::get('/api/vehiculos', 'VehiculoController@list')->middleware('auth');
Route::get('/api/vehiculo-search', 'VehiculoController@searchByParams')->middleware('auth');

//TIPO VEHICULO
Route::get('/api/tipo-vehiculo-search', 'TipoVehiculoController@searchByParams')->middleware('auth');

//TIPO CARGA
Route::get('/api/tipo-carga', 'CargaController@searchByParams')->middleware('auth');

//CIUDADES
Route::get('/api/ciudades-search', 'CiudadController@searchByParams')->middleware('auth');
Route::get('/api/vehiculos/search', 'VehiculoController@search')->middleware('auth');

