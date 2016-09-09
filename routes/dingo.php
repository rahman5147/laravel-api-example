<?php

// Dingo ROUTE

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
	$api->get('/', function() {
        return ['Fruits' => 'Delicious and healthy!'];
    });

    $api->get('fruits', 'App\Http\Controllers\FruitsController@index');

	$api->get('test', function () {
        return 'It is ok';
    });
});