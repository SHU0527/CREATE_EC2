<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeasoningsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seasonings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name')->unique('name');
			$table->string('tea_spoon', 5);
			$table->string('table_spoon', 5);
			$table->string('cup', 5);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('seasonings');
	}

}
