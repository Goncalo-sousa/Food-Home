<?php

use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', 'Api\UserController@index');
Route::get('/products', 'Api\ProductController@index');

Route::get('/users/{user}', 'Api\UserController@show');
Route::put('users/{user}', 'Api\UserController@update');
Route::delete('users/{user}', 'Api\UserController@destroy');

Route::middleware('auth:sanctum')->get('/orders', 'Api\OrderController@index');

Route::middleware('auth:sanctum')->get('/cookDashboard', 'Api\OrderController@index');
Route::middleware('auth:sanctum')->get('/deliverymanDashboard', 'Api\OrderController@index');
Route::middleware('auth:sanctum')->get('/myOrders', 'Api\OrderController@index');

Route::put('orders/{order}', 'Api\OrderController@updateStatus');

Route::put('cookDashboard/{order}', 'Api\OrderController@updateStatus');
Route::put('deliverymanDashboard/{order}', 'Api\OrderController@updateStatus');
Route::put('myOrders/{order}', 'Api\OrderController@updateStatus');

Route::get('orders/{order}', 'Api\OrderController@show');

Route::get('cookDashboard/{order}', 'Api\OrderController@show');
Route::get('deliverymanDashboard/{order}', 'Api\OrderController@show');
Route::get('myOrders/{order}', 'Api\OrderController@show');

Route::get('/orderitems', 'Api\OrderItemController@index');

Route::put('products/{product}', 'Api\ProductController@update');
Route::delete('products/{product}', 'Api\ProductController@destroy');
Route::post('products/filter', 'Api\ProductController@getFilterProducts');

Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'AuthController@register');
