<?php

//header('Access-Control-Allow-Origin: http://localhost:8006');
header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: *,x-xsrf-token,token,content-type');

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


Route::fallback(function () {
    return response()->json(['error' => 'Not Found!'], 404);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');


Route::group(['middleware' => ['auth:api','cors']], function(){

    // Category Routes
    Route::post('category','Api\CategoryController@index');
    Route::post('category/create','Api\CategoryController@create');
    Route::post('category/update/{id}','Api\CategoryController@update');
    Route::post('category/delete/{id}','Api\CategoryController@destroy');
    Route::post('category/changeStatus/{id}','Api\CategoryController@status');

    // Product Routes
    Route::post('product','Api\ProductController@index');
    Route::post('product/create','Api\ProductController@create');
    Route::post('product/update/{id}','Api\ProductController@update');
    Route::post('product/delete/{id}','Api\ProductController@destroy');
    Route::post('product/changeStatus/{id}','Api\ProductController@status');


    // Client Routes
    Route::post('client','Api\ClientController@index');
    Route::post('client/create','Api\ClientController@create');
    Route::post('client/update/{id}','Api\ClientController@update');
    Route::post('client/delete/{id}','Api\ClientController@destroy');

    // Questionnaire Route
    Route::post('questionnaire/create','Api\QuestionnaireController@store');

    // User Route
    Route::post('user','Api\UserController@index');

    Route::post('statistics','Api\HomeController@statistics');
});




