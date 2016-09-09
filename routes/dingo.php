<?php

// Dingo ROUTE

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
	$api->get('/', function() {
        return ['Fruits' => 'Delicious and healthy!'];
    });

    $api->get('fruits', 'App\Http\Controllers\FruitsController@index');

    $api->get('fruit/{id}', 'App\Http\Controllers\FruitsController@show');

    $api->post('authenticate', 'App\Http\Controllers\AuthenticateController@authenticate');
	$api->post('logout', 'App\Http\Controllers\AuthenticateController@logout');
	$api->get('token', 'App\Http\Controllers\AuthenticateController@getToken');

	$api->get('test', function () {
        return 'It is ok';
    });
});