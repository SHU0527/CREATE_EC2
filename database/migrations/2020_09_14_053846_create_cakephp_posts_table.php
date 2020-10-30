<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCakephpPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cakephp_posts', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('blog_title', 50);
			$table->text('blog_message', 65535);
			$table->dateTime('created_date')->nullable();
			$table->dateTime('modified')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cakephp_posts');
	}

}
