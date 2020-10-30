<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSt2MembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('st2_members', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100)->nullable();
			$table->dateTime('birthday')->nullable();
			$table->integer('st2_activity_id')->unsigned()->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('st2_members');
	}

}
