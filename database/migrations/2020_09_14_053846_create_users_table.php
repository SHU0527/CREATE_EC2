<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191)->nullable();
			$table->string('email', 191)->nullable()->unique();
			$table->string('password', 191)->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->string('twitter_id')->nullable();
			$table->string('access_token')->nullable();
			$table->string('access_token_secret')->nullable();
			$table->string('avatar')->nullable();
			$table->string('profile')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
