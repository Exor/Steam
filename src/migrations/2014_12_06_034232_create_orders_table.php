<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('steamapi_orders', function($table)
	    {
			$table->bigInteger('orderid')->unsigned();
			$table->bigInteger('transid')->unsigned();
		    $table->bigInteger('steamid')->unsigned();
		    $table->timestamps();
		    
		    $table->unique('transid');

		    $table->primary('orderid');
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('steamapi_orders');
		Schema::drop('steamapi_orders_test');
	}

}
