<?php

$app->get(
    '/',
    'App\Http\Controllers\WelcomeController@index'
);

$app->post(
    'authorize',
    'App\Http\Controllers\TokenController@authorize'
);

$app->get(
    'resources',
    [
        'middleware' => 'token',
        'uses'       => 'App\Http\Controllers\ResourcesController@index'
    ]
);