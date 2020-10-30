<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRakutenRecipeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rakuten_recipe', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('category_name')->unique('category_name');
			$table->string('category_id', 20)->unique('category_id');
			$table->integer('feeling_recipe_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rakuten_recipe');
	}

}
