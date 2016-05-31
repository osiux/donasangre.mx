<?php

Route::get('/', function () {
    return view('welcome');
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'DonaSangre\Http\Controllers\Api'], function ($api) {

});