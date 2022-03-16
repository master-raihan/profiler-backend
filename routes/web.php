<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->post('/login','Admin\AuthController@login');


$router->post('/file/upload', 'Admin\FileController@uploadCsv');
$router->post('/file/process', 'Admin\FileController@processCsv');

$router->post('/files', 'Admin\FileController@test');
