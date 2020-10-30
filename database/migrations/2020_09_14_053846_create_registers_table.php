<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegistersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->string('images_name')->nullable();
			$table->string('mail', 254);
			$table->string('comments', 20);
			$table->string('pass', 20);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registers');
	}

}
