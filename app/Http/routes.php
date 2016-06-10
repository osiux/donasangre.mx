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
    $api->get('refresh', 'AuthController@refreshToken');

    $api->group(['prefix' => 'geo'], function ($api) {
        $api->get('states', 'GeoController@getStates');
        $api->get('states/{code}', 'GeoController@getState');
        $api->get('postalcodes/{code}', 'GeoController@searchPostalCode');
    });

    $api->group(['middleware' => 'api.auth'], function($api) {
        $api->get('me', 'UserController@getProfile');
        $api->put('me', 'UserController@updateProfile');
    });
});