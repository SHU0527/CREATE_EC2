<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSexyActressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sexy actress', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id');
			$table->string('name');
			$table->string('image_name');
			$table->string('Introduction');
			$table->string('feature');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sexy actress');
	}

}
