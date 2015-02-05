<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('steamapi_items', function($table)
	    {
			$table->bigInteger('uuid')->unsigned();
			$table->string('name');
			$table->string('description');
			$table->integer('price')->unsigned();
		    $table->double('version')->unsigned();
		    $table->timestamps();

		    $table->primary('uuid');
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('steamapi_items');
	}

}
