<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('steamapi_items_users', function($table)
	    {
			$table->bigIncrements('id');
			$table->bigInteger('uuid')->unsigned();
			$table->bigInteger('steamid')->unsigned();

		    $table->timestamps();

		    $table->foreign('uuid')->references('uuid')->on('steamapi_items')->onDelete('cascade');
          	$table->foreign('steamid')->references('steamid')->on('steamapi_users')->onDelete('cascade');
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('steamapi_items_users');
	}

}
