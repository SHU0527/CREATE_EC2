<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderDetails extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up() {
		Schema::create('order_details', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('item_id')->comment('購入商品を判別する為');
			$table->integer('order_id')->comment('どの注文に紐づく注文詳細なのか判別する為');
			$table->integer('quantity')->comment('商品購入数を管理する為');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('order_details');
	}
}
