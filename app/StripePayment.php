<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StripePayment extends Model {
	protected $fillable = ['user_id', 'order_id', 'stripe_token'];
	protected $table = 'stripe_payments';
}
