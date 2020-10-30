<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUniversityBbsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('university_bbs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->string('mail', 254);
			$table->string('pass', 20);
			$table->string('title', 100);
			$table->text('message', 65535);
			$table->dateTime('post_date');
			$table->boolean('deleted_flg')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('university_bbs');
	}

}
