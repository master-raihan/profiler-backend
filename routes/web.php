<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->post('/admin/api/v1/login','Admin\AuthController@login');
$router->post('/file/upload', 'Admin\FileController@uploadCsv');
$router->post('/file/parse', 'Admin\FileController@parseCsv');
$router->post('/file/process', 'Admin\FileController@processCsv');
