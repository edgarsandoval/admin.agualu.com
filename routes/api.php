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

Route::get('test_mail', 'APIController@testMail');


Route::post('get_credentials', 'APIController@getCredentials'); // -> para obtener psw.
Route::post('get_authentication', 'APIController@authenticate'); // -> para obtener token

Route::get('import_users', 'APIController@exportUsers');
Route::get('import_products', 'APIController@exportProducts');
Route::get('import_parameters', 'APIController@exportParameters');
Route::post('send_sales', 'APIController@send_sales');
Route::post('send_registration', 'APIController@send_registration');
Route::put('save_credit', 'APIController@save_credit');
Route::post('send_error', 'APIController@send_error');
