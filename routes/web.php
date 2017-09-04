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
    Route::get('mi_perfil', 'UserController@profile')->name('profile');
    Route::get('abonar', 'UserController@budget')->name('budget');
    Route::get('payment', 'UserController@switch_payment')->name('switch_payment');
    Route::get('ticket/{id}', 'OpenpayController@ticket')->name('stores_ticket');

    Route::get('/', 'UserController@index')->name('users');
    Route::get('crear', 'UserController@create')->name('add_user');
    Route::post('/', 'UserController@store')->name('store_user');
    Route::get('{id}', 'UserController@show')->name('view_user');
    Route::get('{id}/editar', 'UserController@edit')->name('edit_user');
    Route::put('{id}', 'UserController@update')->name('update_user');
    Route::delete('{id}', 'UserController@destroy')->name('delete_user');
});

Route::get('state/{id}', 'StateController@show');


Route::group(['prefix' => 'rangos'], function() {
    Route::get('/', 'RangeController@index')->name('ranges');
    Route::get('crear', 'RangeController@create')->name('add_range');
    Route::post('/', 'RangeController@store')->name('store_range');
    Route::get('{id}', 'RangeController@show')->name('view_range');
    Route::get('{id}/editar', 'RangeController@edit')->name('edit_range');
    Route::put('{id}', 'RangeController@update')->name('update_range');
    Route::delete('{id}', 'RangeController@destroy')->name('delete_range');
});


Route::group(['prefix' => 'productos'], function() {
    Route::get('/', 'ProductController@index')->name('products');
    Route::get('crear', 'ProductController@create')->name('add_product');
    Route::post('/', 'ProductController@store')->name('store_product');
    Route::get('{id}', 'ProductController@show')->name('view_product');
    Route::get('{id}/editar', 'ProductController@edit')->name('edit_product');
    Route::put('{id}', 'ProductController@update')->name('update_product');
    Route::delete('{id}', 'ProductController@destroy')->name('delete_product');
});

Route::group(['prefix' => 'openpay'], function() {
    Route::post('card', 'OpenpayController@card')->name('card_payment');
    Route::post('stores', 'OpenpayController@stores')->name('stores_payment');
    Route::post('webhook', 'OpenpayController@webhook')->name('webhook');
});
