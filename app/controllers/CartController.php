<?php

class CartController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function addProduct()
	{
		$id = 1;
		$amount = 1;
		$options = array(
				'model' => 'pew'
			);

		Cart::add($id, $amount, $options);
	}

	public function editProduct()
	{
		Cart::edit($id, $amount, $options);
	}

	public function removeProduct()
	{
		Cart::remove($id);
	}

}