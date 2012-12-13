<?php

class Cart extends Eloquent {

	protected $table = 'cart';
	 /**
	 * Add new product to the cart
	 *
	 * @var id
	 * @var amount
	 * @var options
	 */
	static function add($id, $amount, $options)
	{
		$product = Cart::exists();
			$product->product = $id;
			$product->cart = Cart::current()->id;
			$product->amount = $product->amount + $amount;
		$product->save();

		// Redirect back to product page
		return Redirect::action('CartController@showWelcome');
	}

	/**
	 * Edit a product in the cart
	 *
	 * @var id
	 * @var amount
	 * @var options
	 */
	static function edit($id, $amount, $options)
	{
		return $this->password;
	}

	/**
	 * Remove product from the cart
	 *
	 * @var id
	 * @var amount
	 * @var options
	 */
	static function remove($id)
	{
		return $this->password;
	}


	static function exists()
	{
		if(!Session::get('cart'))
		{
			Session::put('cart', 3);	
		}
			
		return Cart::find(Session::get('cart'));
	}

	static function current()
	{
		return Cart::find(Session::get('cart'));
	}

}