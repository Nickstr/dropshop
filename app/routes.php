<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



Route::get('/', 'CartController@showWelcome');



/* Product routes */
Route::post('cart/add', 'CartController@addProduct');
Route::post('cart/edit', 'CartController@editProduct');
Route::post('cart/remove', 'CartController@removeProduct');





/*
|---------------------------------------
| Listen for the add product event.
|---------------------------------------
| Expects
|	- id
|	- Amount
|
*/

Event::listen('addProduct', function($amount, $title)
{
	echo "$amount of $title added";
});

/*
|---------------------------------------
| Listen for the delete item event.
|---------------------------------------
| Expects
|	- id
|
*/

Event::listen('removeProduct', function($id)
{
	echo 'Product deleted';
});

/*
|---------------------------------------
| Listen for the edit item event.
|---------------------------------------
| Expects
|	- id
|	- Amount
|
*/

Event::listen('editProduct', function($id, $amount)
{
	echo 'Product edited';
});