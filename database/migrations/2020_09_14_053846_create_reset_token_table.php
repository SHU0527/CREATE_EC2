<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResetTokenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reset_token', function(Blueprint $table)
		{
			$table->integer('users_id')->primary();
			$table->timestamp('mail_sent_date')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('pass_reset_token');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reset_token');
	}

}
