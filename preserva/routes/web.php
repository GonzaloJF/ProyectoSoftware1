<?php

use Illuminate\Support\Facades\Route;
use App\reserva;

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

Route::get('/', 'GuestController@index');

Route::get('/quienes_somos', function (){
    return view('quienes_somos');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('/home/cambiopass','CambiopassController@cambiopass');
Route::post('/home/cambiopass','CambiopassController@cambiopass_actualizar');

Route::get('/usuarios','AdminController@usuarios');
Route::get('/usuarios/{usuario}/edit','AdminController@edit');
Route::patch('/usuarios/{usuario}','AdminController@update');
Route::delete('/usuarios/{usuario}','AdminController@destroy');

Route::get('/reserva/create', 'ReservaController@create');
Route::post('/reserva', 'ReservaController@store');
Route::get('/reserva','ReservaController@reservas_anteriores');
Route::get('/reserva/{reserva}/edit','ReservaController@edit');
Route::patch('/reserva/{reserva}','ReservaController@update');
Route::delete('/reserva/{reserva}','ReservaController@destroy');
 

Route::get('/solicitud/create', 'SolicitudController@create');
Route::post('/solicitud', 'SolicitudController@store'); 
Route::get('/solicitud','SolicitudController@solicitudes_anteriores');

Route::get('/evaluacion','EvaluacionController@solicitudes_anteriores');
Route::get('/evaluacion/{solicitud}/edit','EvaluacionController@edit');
Route::patch('/evaluacion/{solicitud}','EvaluacionController@update');

Route::get('/laboratorio/create','LaboratorioController@create');
Route::post('/laboratorio/create','LaboratorioController@store');
Route::get('/laboratorio','GuestController@show');