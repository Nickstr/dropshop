<?php

use Illuminate\Database\Migrations\Migration;

class CreateCartTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cart', function($table)
		{
		    $table->increments('id');
		    $table->integer('cart');
		    $table->integer('product');
		    $table->integer('amount');
		    $table->decimal('price', 5, 2);
		    $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}