<?php

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

use App\User;
use Illuminate\Http\Request;

$app->get('/', ['middleware' => 'auth', function () use ($app) {
    return $app->version();
}]);

$app->get('/users', ['middleware' => 'auth', function () {
    return User::all();
}]);

$app->get('/users/{id}', ['middleware' => 'auth', function ($id) {
    return User::findOrFail($id);
}]);

$app->post('/users', ['middleware' => 'auth', function (Request $request) {
    User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'api_token' => $token = str_random(32)
    ]);
    return $token;
}]);