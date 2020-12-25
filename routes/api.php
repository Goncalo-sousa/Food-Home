<?php

use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/users', 'Api\UserController@index');
Route::get('/products', 'Api\ProductController@index');

Route::get('/users/{user}', 'Api\UserController@show');
Route::put('users/{user}', 'Api\UserController@update');
Route::delete('users/{user}', 'Api\UserController@destroy');

Route::get('/orders', 'Api\OrderController@index');

Route::put('products/{product}', 'Api\ProductController@update');
Route::delete('products/{product}', 'Api\ProductController@destroy');

Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'AuthController@register');
