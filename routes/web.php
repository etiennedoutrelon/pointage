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

// toutes ressources de base
Auth::routes();
Route::resource('pointages','PointageController');
Route::resource('chantiers','ChantierController');
Route::resource('employes','EmployeController');
Route::get('/', 'HomeController@index')->name('/');

//Route pour index des chefs
Route::get('/indexAdmin','PointageController@indexAdmin')->name('indexAdmin');

// Compte gestion
Route::get('/compte', 'UserController@compte')->name('compte');
Route::get('/compte/editer', 'UserController@modifCompte')->name('compte.editer');
Route::post('/avatar/update', 'UserController@update')->name('user.update');
