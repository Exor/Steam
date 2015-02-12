<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddXpToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('steamapi_users', function($table)
		{
		    $table->bigInteger('xp')->unsigned()->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('steamapi_users', function($table)
		{
		    $table->dropColumn('xp');
		});
	}

}
