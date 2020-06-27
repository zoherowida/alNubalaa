<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
return 'Not Found';
    return $router->app->version();
});

$router->group(['prefix' => 'api/'], function ($app) {
    $app->post('register','AuthController@register');

    $app->post('login/','AuthController@login');

    // Category Routes
    $app->post('category/all','CategoryController@show');
    $app->post('category/create','CategoryController@create');
    $app->post('category/update/{id}','CategoryController@update');

    // Product Routes
    $app->post('product/all','ProductController@show');
    $app->post('product/create','ProductController@create');
    $app->post('product/update/{id}','ProductController@update');

    // Client Routes
     $app->post('client/all','ClientController@show');
     $app->post('client/create','ClientController@create');
     $app->post('client/update/{id}','ClientController@update');

});
