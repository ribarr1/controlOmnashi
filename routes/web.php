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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/roles/listado','RolesController@listado')->name('roles.listado');

Route::resource('/roles', 'RolesController', [

    'middleware' => 'role:admin',
    'uses' => 'RolesController@index',
]);

Route::get('/users/listado','UsersController@listado')->name('users.listado');

Route::resource('/users', 'UsersController', [

    'middleware' => 'role:admin',
    'uses' => 'UsersController@index',
]);

Route::get('/paquetes/listado','PaqueteController@listado')->name('paquetes.listado');
//Route::resource('paquetes','PaqueteController');
Route::resource('/paquetes', 'PaqueteController', [

    'middleware' => 'role:admin',
    'uses' => 'PaqueteController@index',
]);









