<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up() {
		Schema::create('orders', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->comment('どのユーザーの注文詳細か判別する為');
			$table->string('order_number')->comment('ハイフン付きの注文番号にする為、ユーザーが注文状況を問い合わせられるようにする為');
			$table->integer('total_payment')->comment('支払合計');
			$table->string('post_number')->comment('支払い時、お届け先を保管するためのカラム');
			$table->string('prefectures')->comment('支払い時、お届け先を保管するためのカラム');
			$table->string('address1')->comment('支払い時、お届け先を保管するためのカラム');
			$table->string('address2')->comment('支払い時、お届け先を保管するためのカラム');
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
		Schema::dropIfExists('orders');
	}
}
