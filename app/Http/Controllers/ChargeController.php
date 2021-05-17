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



class ChargeController extends Controller
{

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
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));
            

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => 1000,
                'currency' => 'jpy'
            ));
            
            $orders = Order::create(array(
                'user_id' => Auth::id(),
                'order_number' => "4444-4444-4444",
                'total_payment' => 150,
                'post_number' => "515-0815",
                'prefectures' => "三重県",
                'address1' => "松阪市西町",
                'address2' => "2555-2",
            ));

            $order_detail = OrderDetail::create(array(
                'item_id' => 123,
                'order_id' => $orders->id,
                'quantity' => 5,
            ));

            $insert_stripe_payments = StripePayment::create(array(
                'user_id' => Auth::id(),
                'order_id' => $orders->id,
                'stripe_token' => $request->stripeToken,
            ));
            return redirect(route('user.index'))->with('flash_message', '支払いが完了致しました');

        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
