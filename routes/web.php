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
    Route::post('/', 'UserController@store')->name('store_user');
    Route::get('ver/{id}', 'UserController@show')->name('view_user');
    Route::get('editar/{id}', 'UserController@edit')->name('edit_user');
    Route::put('{id}', 'UserController@update')->name('update_user');
    Route::delete('{id}', 'UserController@destroy')->name('delete_user');
    Route::get('mi_perfil', 'UserController@profile')->name('profile');
    Route::get('abonar', 'UserController@budget')->name('budget');
    Route::get('payment', 'UserController@switch_payment')->name('switch_payment');
});

Route::get('state/{id}', 'StateController@show');


Route::group(['prefix' => 'rangos'], function() {
    Route::get('/', 'RangeController@index')->name('ranges');
    Route::get('añadir', 'RangeController@create')->name('add_range');
    Route::post('/', 'RangeController@store')->name('store_range');
    Route::get('ver/{id}', 'RangeController@show')->name('view_range');
    Route::get('editar/{id}', 'RangeController@edit')->name('edit_range');
    Route::put('{id}', 'RangeController@update')->name('update_range');
    Route::delete('{id}', 'RangeController@destroy')->name('delete_range');
});
