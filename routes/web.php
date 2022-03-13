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

$router->post('/admin/api/v1/login','Admin\AuthController@login');
$router->post('/file', 'Admin\FileController@parseCsv');

// Route::group([

//     'prefix' => 'api'

// ], function ($router) {
//     Route::post('login', 'AuthController@login');
//     Route::post('logout', 'AuthController@logout');
//     Route::post('refresh', 'AuthController@refresh');
//     Route::post('user-profile', 'AuthController@me');

// });
