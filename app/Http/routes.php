<?php
Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index',
]);

Route::get('/{vue_capture?}', [
    'as' => 'home',
    'uses' => 'HomeController@index',
])->where('vue_capture', '[\/\w\.-]*');

/**
 * Api Routes
 */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'DonaSangre\Http\Controllers\Api'], function ($api) {
    $api->post('register', 'AuthController@register');
    $api->post('login', 'AuthController@login');
    $api->post('refresh', 'AuthController@refreshToken');
});