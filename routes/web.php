<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use App\Http\Controllers\ProyectoresController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/itma-proyectores/home','ProyectoresController@getProyectores');
// este es el home mira, se va a ProyectoresController qu es un controller y 
//a su metodo getProyectores

//son la rutas para las rutas que manejamos
Route::get('/getProyectores', 'ProyectoresController@getProyectores');

Route::get('/getPrestamo/{id}', 'ProyectoresController@getPrestamo');

Route::get('/proyectores/home', 'ProyectoresController@home');

Route::get('/profesores/home', 'ProyectoresController@profesores');

Route::get('/prestamos/home', 'ProyectoresController@prestamos');

Route::get('/delete/proyector/{id}', 'ProyectoresController@delete');


// Peticiones POST

Route::post('/postPrestar', 'ProyectoresController@postPrestar');

Route::post('/postEntregar', 'ProyectoresController@postEntregar');

Route::post('/postUpdateProyector', 'ProyectoresController@update');

Route::post('/postNuevoProyector', 'ProyectoresController@add');

Route::post('/postDeletePrestamo', 'ProyectoresController@deletePrestamo');

Route::post('/postUpdateProfesor', 'ProyectoresController@updateProfesor');

Route::post('/postSaveProfesor', 'ProyectoresController@saveProfesor');

Route::post('/postSaveProyector', 'ProyectoresController@saveProyector');