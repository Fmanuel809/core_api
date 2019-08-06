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
    return $router->app->version();
});

$router->get('key', function () {
    return str_random(32);
});

$router->group(['middleware' => 'content_type'], function () use ($router){
    # LOGIN
    $router->post('auth/login', ['uses' => 'AuthController@authenticate']);

    # STORE INDEX
    $router->get('products',             ['uses' => 'Store\ProductsController@index']);
    $router->get('products/{id}',        ['uses' => 'Store\ProductsController@get']);

    $router->group(['middleware' => 'jwt.auth'], function () use ($router){
        # CORE
        $router->get('users',            ['uses' => 'UsersController@index']);
        $router->get('users/{id}',       ['uses' => 'UsersController@getUserById']);
        $router->post('getUserActive',   ['uses' => 'UsersController@getUserByToken']);
        $router->post('users',           ['uses' => 'UsersController@createUser']);
        $router->put('users/{id}',       ['uses' => 'UsersController@updateUser']);
        $router->delete('users/{id}',    ['uses' => 'UsersController@deleteUser']);

        # STORE
        $router->post('products',        ['uses' => 'Store\ProductsController@create']);
        $router->put('products/{id}',    ['uses' => 'Store\ProductsController@update']);
        $router->delete('products/{id}', ['uses' => 'Store\ProductsController@delete']);
    });
});
