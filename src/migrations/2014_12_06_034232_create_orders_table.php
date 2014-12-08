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
			$table->bigIncrements('id');
			$table->bigInteger('orderid')->unsigned();
			$table->bigInteger('transid')->unsigned();
		    $table->bigInteger('steamid')->unsigned();
		    $table->string('status', 20);
		    $table->string('currency', 3);
		    $table->timestamps();
		    $table->string('country', 2);
		    $table->string('usstate', 2);		    
	    });

	    Schema::create('steamapi_items', function($table)
	    {
			$table->bigIncrements('id');	    
	    });	    
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
