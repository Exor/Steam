<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('steamapi_items_orders', function($table)
	    {
			$table->bigIncrements('id');
			$table->bigInteger('uuid')->unsigned();
			$table->bigInteger('orderid')->unsigned();

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
		Schema::drop('steamapi_items_orders');
	}

}
