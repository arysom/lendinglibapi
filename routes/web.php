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

$router->post('/login', 'LoginController@login');

$router->group(['middleware' => 'auth'], function () use ($router) {

    $router->get('/things', 'ThingController@index');
    $router->get('/things/{id}', 'ThingController@get');
    $router->post('/things', 'ThingController@insert');
    $router->put('/things/{id}', 'ThingController@update');
    $router->delete('/things/{id}', 'ThingController@delete');


});
