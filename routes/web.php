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
