<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
    return response()->json('success');
});

$router->get('/version', function () use ($router) {
    return $router->app->version();
});

$router->post('/login','AdminController@login');

// Route::group([

//     'prefix' => 'api'

// ], function ($router) {
//     Route::post('login', 'AdminController@login');
//     Route::post('logout', 'AdminController@logout');
//     Route::post('refresh', 'AdminController@refresh');
//     Route::post('user-profile', 'AdminController@me');

// });