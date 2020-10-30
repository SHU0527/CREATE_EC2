<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBoardPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('board_posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('register_id');
			$table->string('post_title', 100);
			$table->text('post_message', 65535);
			$table->timestamp('post_date')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->boolean('deleted_flag')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('board_posts');
	}

}
