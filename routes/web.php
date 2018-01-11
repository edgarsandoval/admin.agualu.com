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

Route::resource('users', 'UserController');

Route::group(['prefix' => 'usuarios'], function() {
    Route::get('mi_perfil', 'UserController@profile')->name('profile');
    Route::get('abonar', 'UserController@budget')->name('budget');
    Route::get('payment', 'UserController@switch_payment')->name('switch_payment');
    Route::get('ticket/{id}', 'OpenpayController@ticket')->name('stores_ticket');
    Route::get('directorio', 'UserController@directory')->name('user_directory');
    Route::get('ver_ganancias/{id?}', 'UserController@earnings')->name('earnings');
    Route::get('ver_red/{id?}', 'UserController@network')->name('network');
    Route::get('estados_cuenta', 'UserController@accountStatements')->name('accountStatements');
    Route::get('{id}', 'UserController@show')->name('view_user');
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

Route::group(['prefix' => 'pedidos'], function() {
    Route::get('/', 'OrderController@index')->name('orders');
    Route::get('ver_historial', 'OrderController@history')->name('history');
    Route::get('{id}', 'OrderController@show')->name('view_order');
    Route::get('{id}/editar', 'OrderController@edit')->name('edit_order');
    Route::put('{id}', 'OrderController@update')->name('update_order');
});

Route::group(['prefix' => 'maquinas'], function() {
    Route::get('/', 'MachineController@index')->name('machines');
    Route::get('crear', 'MachineController@create')->name('add_machine');
    Route::post('/', 'MachineController@store')->name('store_machine');
    Route::get('{id}', 'MachineController@show')->name('view_machine');
    Route::get('{id}/editar', 'MachineController@edit')->name('edit_machine');
    Route::put('{id}', 'MachineController@update')->name('update_machine');
    Route::delete('{id}', 'MachineController@destroy')->name('delete_machine');
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
});

Route::group(['prefix' => 'carrito'], function() {
    Route::get('/', 'CartController@index')->name('cart');
    Route::post('add', 'CartController@add')->name('cart_add');
    Route::post('delete', 'CartController@delete')->name('cart_delete');
    Route::post('process', 'CartController@process')->name('cart_process');
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::group(['prefix' => 'usuarios'], function() {
        Route::get('/', 'UserController@index')->name('users');
        Route::get('crear', 'UserController@create')->name('add_user');
        Route::post('/', 'UserController@store')->name('store_user');
        Route::get('{id}/editar', 'UserController@edit')->name('edit_user');
        Route::put('{id}', 'UserController@update')->name('update_user');
        Route::delete('{id}', 'UserController@destroy')->name('delete_user');
    });

    Route::group(['prefix' => 'parametros'], function() {
        Route::get('/', 'SettingController@index')->name('parameters');
        Route::put('/', 'SettingController@update')->name('update_parameter');
    });

    Route::group(['prefix' => 'roles'], function() {
        Route::get('/', 'RoleController@index')->name('roles');
        Route::get('crear', 'RoleController@create')->name('add_role');
        Route::post('/', 'RoleController@store')->name('store_role');
        Route::get('{id}', 'RoleController@show')->name('view_role');
        Route::get('{id}/editar', 'RoleController@edit')->name('edit_role');
        Route::put('{id}', 'RoleController@update')->name('update_role');
        Route::delete('{id}', 'RoleController@destroy')->name('delete_role');
    });

    Route::group(['prefix' => 'permisos'], function() {
        Route::get('/', 'PermissionController@index')->name('permissions');
        Route::get('crear', 'PermissionController@create')->name('add_permission');
        Route::post('/', 'PermissionController@store')->name('store_permission');
        Route::get('{id}', 'PermissionController@show')->name('view_permission');
        Route::get('{id}/editar', 'PermissionController@edit')->name('edit_permission');
        Route::put('{id}', 'PermissionController@update')->name('update_permission');
        Route::delete('{id}', 'PermissionController@destroy')->name('delete_permission');
    });
});
