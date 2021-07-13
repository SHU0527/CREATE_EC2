<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'shipping_name', 'order_number', 'total_payment', 'post_number', 'prefectures', 'address1', 'address2'];

}
