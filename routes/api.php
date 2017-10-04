<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test',function(){
    return response([1,2,3,4],200);
});
Route::post('get_credentials', 'APIController@getCredentials'); // -> para obtener psw.
Route::post('get_authentication', 'APIController@authenticate'); // -> para obtener toke
Route::post('authenticate', 'APIController@authenticate');
Route::get('import_users', 'APIController@import_users');
Route::get('import_products', 'APIController@import_products');
Route::get('import_parameters', 'APIController@import_parameters');
Route::post('send_sales', 'APIController@send_sales');
Route::post('send_registration', 'APIController@send_registration');
Route::put('save_credit', 'APIController@save_credit');
Route::post('send_error', 'APIController@send_error');
