<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StripePayments extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up() {
		Schema::create('stripe_payments', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->comment('どのユーザーの決済情報か判別する為');
			$table->integer('order_id')->comment('決済金額を注文詳細の支払合計金額にする為');
			$table->string('stripe_token')->comment('決済時にstripeから発行されるコード保存');
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
		Schema::dropIfExists('stripe_payments');
	}
}
