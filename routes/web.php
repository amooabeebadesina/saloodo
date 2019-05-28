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
    echo "You lost you way?";
});

$router->group(['prefix' => 'v1'], function () use ($router) {

    $router->post('login', 'AuthController@authenticate');
    $router->post('register', 'AuthController@register');
    $router->post('merchant-requests', 'MerchantController@merchantRequest');
    $router->get('ping', 'GeneralController@index');
    $router->get('user', 'UserController@getUser');

    $router->group(['middleware' => 'jwt-auth'], function () use ($router) {
        $router->get('token/{data}', 'UserController@verifyUser');

    });
});
