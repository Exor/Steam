<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserUnlocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('steamapi_unlocks', function($table)
	    {
			$table->bigIncrements('id');
			$table->bigInteger('steamid')->unsigned();
			$table->bigInteger('uuid')->unsigned();

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
		Schema::drop('steamapi_unlocks');
	}

}
