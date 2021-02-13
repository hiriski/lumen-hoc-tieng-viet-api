<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

function isLocal() {
    return app()->environment('local') ? true : false;
}

$router->get('/', function () use ($router) {
    // return $router->app->version();
    return response()->json([
        'message'   => 'Application is running...'
    ]);
});

if(isLocal()) {
    $router->get('/get-app-key', function() use ($router) {
        return \Illuminate\Support\Str::random(32);
    });
}
