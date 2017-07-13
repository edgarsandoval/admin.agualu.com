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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'usuarios'], function() {
    Route::get('/', 'UserController@index')->name('users');
    Route::get('añadir', 'UserController@create')->name('add_user');
    Route::get('ver/{id}', 'UserController@show')->name('view_user');
    Route::get('editar/{id}', 'UserController@edit')->name('edit_user');
});
