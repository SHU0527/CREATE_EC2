<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\facades\Auth;

class Cart extends Model
{
	use SoftDeletes; //ソフトデリート準備
	protected $fillable = ['user_id', 'item_id', 'quantity'];
	protected $table = 'carts';

	public function item() {
		//リレーション
		return $this->belongsTo('App\Item', 'item_id');
	}
	public function all_get($auth_id) {
		//ログインユーザーのカートデータ読み込み
		$carts = $this->where('user_id', $auth_id)->get();
		return $carts;
	}
	public function add_db($item_id, $add_qty) {
		$item = (new item)->findOrFail($item_id);
		$qty = $item->quantity;
		//在庫なしバリデーション
		if ($qty <= 0) {
			return false;
		}
		$cart = $this->firstOrCreate(['user_id' => Auth::id(), 'item_id' => $item_id], ['quantity' => 0]);
		$cart->increment('quantity', $add_qty);
		$item->decrement('quantity', $add_qty);
		return true;
	}
	public function soft_delete_db($cart_id) {
		$cart = $this->findOrCreate($cart_id);
		if ($cart->user_id == Auth::id()) {
			$item_id = $cart->item_id;
			$qty = $cart->quantity;
			$cart->delete();
			$item = (new Item)->find($item_id);
			$item->increment('quantity', $qty);
			return true;
		}
		return false;
	}
	public function subtotal() {
		$result = $this->item->price * $this->quantity;
		return $result;
	}
}

