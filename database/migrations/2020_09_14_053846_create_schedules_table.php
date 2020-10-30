<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('schedules', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('slack_id', 30);
			$table->string('schedule_1', 30)->nullable();
			$table->string('schedule_2', 30)->nullable();
			$table->string('schedule_3', 30)->nullable();
			$table->string('schedule_4', 30)->nullable();
			$table->string('schedule_5', 30)->nullable();
			$table->integer('delete_flag')->unsigned()->default(0);
			$table->timestamps();
			$table->integer('deleted_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('schedules');
	}

}
