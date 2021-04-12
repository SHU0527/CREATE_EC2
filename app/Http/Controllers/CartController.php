<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use App\Cart;
use DB;
use App\Item;
use App\Http\Requests;


class CartController extends Controller
{
	public function __construct(Cart $cart) {
		$this->cart = $cart;
	}
	public function index() {
		$carts = $this->cart->all_get(Auth::id());
        $subtotals = $this->subtotals($carts);

		return view('cart.index', compact('carts', 'subtotals'));
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
	{
		$item_id = $request->input('item_id');
		$this->cart->add_db($item_id, 1);
		return redirect('carts');
        
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $cart_id)
	{
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
		return redirect('carts');
	}

    private function subtotals($carts) {
        $result = 0;
        foreach ($carts as $cart) {
            $result += $cart->subtotal();
        }
        return $result;
    }
    
}
