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


/** @var TYPE_NAME $router */

$router->get('/', function () use ($router) {
    echo "You lost you way?";
});
$router->get('ping', 'UtilityController@ping');
$router->post('login', 'UserController@login');

$router->group(['middleware' => 'jwt-auth'], function () use ($router) {

    $router->group(['middleware' => 'admin'], function () use ($router) {
        $router->post('/products', 'ProductController@create');
    });

});
