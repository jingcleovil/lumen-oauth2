<?php

$app->get(
    '/',
    'App\Http\Controllers\WelcomeController@index'
);

$app->post(
    'authorize',
    'App\Http\Controllers\AccessToken@authorize'
);

$app->post(
    'authorize/webtoken',
    'App\Http\Controllers\AccessToken@webtoken'
);

$app->get(
    'resources',
    [
        'middleware' => 'token',
        'uses'       => 'App\Http\Controllers\ResourcesController@index'
    ]
);