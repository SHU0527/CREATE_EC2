<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePassResetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pass_reset', function(Blueprint $table)
		{
			$table->integer('register_id');
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
		Schema::drop('pass_reset');
	}

}
