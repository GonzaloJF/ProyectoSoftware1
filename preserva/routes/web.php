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

Route::get('/', 'GuestController@index');

Route::get('/quienes_somos', function (){
    return view('quienes_somos');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::post('login', 'Auth\LoginController@login')->name('login');

Route::get('/reserva/create', 'ReservaController@create');
Route::post('/reserva', 'ReservaController@store');

Route::get('/reserva', function (){
    return view('reserva');
});