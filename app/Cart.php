<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\facades\Auth;
use App\Item;
use DB;

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
	public function add_db($item_id) {
		$item = (new item)->findOrFail($item_id);
		$qty = $item->stocks;
		//在庫なしバリデーション
		if ($qty <= 0) {
			return false;
		}
		$cart = $this->firstOrCreate(['user_id' => Auth::id(), 'item_id' => $item_id], ['quantity' => 1]);
		$cart->increment('quantity', 1);
		$item->decrement('stocks', 1);
		return true;
	}
	/*public function soft_delete_db(Request $request, $cart_id) {
		DB::transaction(function () use ($cart_id, $request) {
			$cart = Cart::find($cart_id);
			if ($cart->user_id == Auth::id()) {
				$item_id = $cart->item_id;
				$stock_return = $cart->quantity;
				$cart->delete();
				$item = (new Item)->find($item_id);
				$item->increment('stocks', $stock_return);
			}
		});
		return redirect(route('cart.index'));
	}*/
	public function subtotal() {
		$result = $this->item->price * $this->quantity;
		return $result;
	}
}

