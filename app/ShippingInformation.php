<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ShippingInformation extends Model
{
    use SoftDeletes; //ソフトデリート準備
	protected $fillable = ['shipping_name', 'post_number', 'prefectures', 'address1', 'address2', 'phone_number'];
	protected $table = 'shipping_informations';

	public function user() {
        return $this->belongsTo('App\User');
	}
}
