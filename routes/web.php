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
$router->get('/ping', 'UtilityController@ping');
// Fetch products and their prices
$router->get('/products', 'ProductController@getAll');

$router->post('/login', 'UserController@login');

$router->group(['middleware' => 'jwt-auth'], function () use ($router) {

    $router->get('/orders', 'OrderController@getOrders');

    $router->post('/orders', 'OrderController@createCustomerOrder');

    $router->group(['middleware' => 'admin'], function () use ($router) {
        // Enable Admin to create new product
        $router->post('/products', 'ProductController@create');
        // Enable Admin to create new bundles
        $router->post('/bundles', 'ProductController@createBundle');
        // Enable Admin to update product prices and discount
        $router->put('/products/{id}', 'ProductController@update');
    });

});
