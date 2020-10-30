<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->string('title', 100)->nullable();
			$table->text('body', 65535);
			$table->timestamp('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('modified')->nullable();
			$table->boolean('deleted')->default(0);
			$table->dateTime('deleted_date')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}

}
