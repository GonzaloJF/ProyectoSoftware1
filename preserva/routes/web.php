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

/*aca se encuentran las rutas de donde obtienen y envian los datos*/

Route::get('/', 'GuestController@index');

Route::get('/quienes_somos', function (){
    return view('quienes_somos');
});

Route::get('/horarios', function (){
    return view('horarios');
});

Auth::routes();

//Route::resource('home','HomeController');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home.show', 'HomeController@show')->name('show');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('/home/cambiopass','CambiopassController@cambiopass');
Route::post('/home/cambiopass','CambiopassController@cambiopass_actualizar');
Route::get('/home/{evento}/info','HomeController@info_evento');

Route::get('/usuarios','AdminController@usuarios');
Route::get('/usuarios/{usuario}/edit','AdminController@edit');
Route::patch('/usuarios/{usuario}','AdminController@update');
Route::delete('/usuarios/{usuario}','AdminController@destroy');

Route::get('/reserva/create', 'ReservaController@create');
Route::post('/reserva', 'ReservaController@store');
Route::get('/reserva','ReservaController@reservas_anteriores');
//
Route::get('/reserva/{reserva}/cambio_fechas','ReservaController@cambio_fechas');
Route::patch('/reserva/{reserva}/update_fechas','ReservaController@update_fechas');
//
Route::get('/reserva/{reserva}/cambio_bloques','ReservaController@cambio_bloques');
Route::patch('/reserva/{reserva}/update_bloques','ReservaController@update_bloques');
//
Route::get('/reserva/{reserva}/inactividad','ReservaController@inactividad');
Route::patch('/reserva/{reserva}','ReservaController@inactividad_periodo');
//
Route::delete('/reserva/{reserva}','ReservaController@destroy');
//
Route::get('/reserva/{reserva}/eliminar_periodo','ReservaController@eliminar_periodo');
Route::patch('/reserva/{reserva}','ReservaController@eliminar_periodo_destroy');
//-------------------------------------------------------------------------------

Route::get('/solicitud/create', 'SolicitudController@create');
Route::post('/solicitud', 'SolicitudController@store'); 
Route::get('/solicitud','SolicitudController@solicitudes_anteriores');

Route::get('/evaluacion','EvaluacionController@solicitudes_anteriores');
Route::get('/evaluacion/{solicitud}/edit','EvaluacionController@edit');
Route::patch('/evaluacion/{solicitud}','EvaluacionController@update');

Route::get('/laboratorio/create','LaboratorioController@create');
Route::post('/laboratorio/create','LaboratorioController@store');
Route::get('/laboratorio','GuestController@show');
Route::get('/laboratorio/{laboratorio}/edit','LaboratorioController@edit');
Route::patch('/laboratorio/{laboratorio}','LaboratorioController@update');