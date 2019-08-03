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

    $router->post('auth/login', ['uses' => 'AuthController@authenticate']);

    $router->get('users', ['uses' => 'UsersController@index']);
    $router->get('users/{id}', ['uses' => 'UsersController@getUserById']);
    $router->post('users', ['uses' => 'UsersController@createUser']);
    $router->put('users/{id}', ['uses' => 'UsersController@updateUser']);
    $router->delete('users/{id}', ['uses' => 'UsersController@deleteUsers']);
});