<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShippingInformation;
use App\Item;
use App\Cart;
use DB;
use Illuminate\Support\facades\Auth;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\StripePayment;
use App\Order;
use App\OrderDetail;



class ChargeController extends Controller {

	public function __construct(Cart $cart) {
		$this->cart = $cart;
	}

	public function index(Request $request) {
		$shipping_id = $request->shipping_id;
		$shipping_target = ShippingInformation::where('id', $shipping_id)->first();
		$carts = $this->cart->all_get(Auth::id());
		$subtotals = $this->subtotals($carts);
		return view('charge.index', compact('shipping_target', 'carts', 'subtotals'));
	}

	private function subtotals($carts) {
		$result = 0;
		foreach ($carts as $cart) {
			$result += $cart->subtotal();
		}
		return $result;
	}

	public function confirm(Request $request) {
		DB::beginTransaction();
		try {
			Stripe::setApiKey(env('STRIPE_SECRET'));

			$customer = Customer::create(array(
				'email' => $request->stripeEmail,
				'source' => $request->stripeToken
			));

			$charge = Charge::create(array(
				'customer' => $customer->id,
				'amount' => $request->amount,
				'currency' => 'jpy'
			));

			$latestOrder = Order::orderBy('created_at','DESC')->first();
			$orders = Order::create(array(
				'user_id' => Auth::id(),
				'order_number' =>  '#'.str_pad($latestOrder->id + 1, 8, "0", STR_PAD_LEFT),
				'total_payment' => $request->amount,
				'post_number' => $request->post_number,
				'prefectures' => $request->prefectures,
				'address1' => $request->address1,
				'address2' => $request->address2,
				'shipping_name' => $request->shipping_name,
			));

			$item_count = count($request->item_id);
			for ($i = 0; $i < $item_count; $i++) {
				$order_detail = OrderDetail::create(array(
					'item_id' => $request->item_id[$i],
					'order_id' => $orders->id,
					'quantity' => $request->quantity[$i],
				));
			}

			$insert_stripe_payments = StripePayment::create(array(
				'user_id' => Auth::id(),
				'order_id' => $orders->id,
				'stripe_token' => $request->stripeToken,
			));
			if ($insert_stripe_payments) {
				$carts = Cart::where('user_id', Auth::id())->get();
				$cart_count = count($carts);
				for ($i = 0; $i < $cart_count; $i++) {
					$carts[$i]->delete();
				}
			}
			DB::commit();
			$request->session()->regenerateToken();
			return redirect(route('user.index'))->with('flash_message', '支払いが完了致しました');

		} catch (\Exception $e) {
			DB::rollBack();
			if ($charge->id !== null) {
				// 例外が発生すればオーソリを取り消す
				\Stripe\Refund::create(array(
					'charge' => $charge->id,
				));
			}
			return redirect(route('user.index'))->with('flash_message', '支払いに失敗致しました');
		}
	}
}
