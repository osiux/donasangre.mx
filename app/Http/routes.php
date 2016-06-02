<?php
Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index',
]);

/**
 * Api Routes
 */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'DonaSangre\Http\Controllers\Api'], function ($api) {

});