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
//

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');


Route::group(['middleware' => ['auth:api']], function(){

    // Category Routes
    Route::post('category/all','Api\CategoryController@index');
    Route::post('category/create','Api\CategoryController@create');
    Route::post('category/update/{id}','Api\CategoryController@update');

    // Product Routes
    Route::post('product/all','Api\ProductController@index');
    Route::post('product/create','Api\ProductController@create');
    Route::post('product/update/{id}','Api\ProductController@update');

    // Client Routes
    Route::post('client/all','Api\ClientController@index');
    Route::post('client/create','Api\ClientController@create');
    Route::post('client/update/{id}','Api\ClientController@update');
});




