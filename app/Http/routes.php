<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', function() use ($app) {
	return 'NaHeHuo Api Interface';
    //return view()->make('client');
});

$app->post('api/user/login', function() use($app) {
    $credentials = app()->make('request')->input("credentials");   
    return $app->make('App\Auth\Proxy')->attemptLogin($credentials);
});

$app->post('refresh-token', function() use($app) {
    return $app->make('App\Auth\Proxy')->attemptRefresh();
});

$app->post('oauth/access-token', function() use($app) {
    return response()->json($app->make('oauth2-server.authorizer')->issueAccessToken());
});

$app->group(['prefix' => 'api', 'middleware' => 'oauth'], function($app)
{
    /*
	$app->get('resource', function() {
        return response()->json([
            "id" => 1,
            "name" => "A resource"
        ]);
    });
    */
    
    $app->get('user/profile', 'App\Http\Controllers\Users\UserController@getProfile');

});
$app->group(['prefix' => 'api'], function ($app) 
{
	$app->get('user/check_phonecode', 'App\Http\Controllers\CommonController@checkPhoneCode');
	$app->get('user/check_phone', 'App\Http\Controllers\CommonController@checkPhone');
	$app->post('user/register', 'App\Http\Controllers\Users\UserController@register');
	//$app->post('user/login', 'App\Http\Controllers\Users\UserController@login');
	$app->get('user/testprofile', 'App\Http\Controllers\Users\UserController@getProfile');
});

