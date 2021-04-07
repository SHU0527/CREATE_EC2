<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShippingInformation;
use Illuminate\Support\Facades\Auth;



class ShippingController extends Controller
{
    public function index() {
		$shippings = ShippingInformation::where('user_id', Auth::id())->get();
        return view('shipping.index', compact('shippings'));
	}
	
	public function showCreateForm() {
        return view('shipping.create');
	}

    public function create(Request $request) {
		$shipping_information = new ShippingInformation;
		$shipping_information->user_id = Auth::id();
		$shipping_information->shipping_name = $request->shipping_name;
		$shipping_information->post_number = $request->post_number;
		$shipping_information->prefectures = $request->prefectures;
		$shipping_information->address1 = $request->address1;
        $shipping_information->address2 = $request->address2;
		$shipping_information->phone_number = $request->phone_number;
		$shipping_information->save();
		return redirect(route('shipping.index'))->with('flash_message', 'お届け先住所の登録が完了しました');;
	}
	public function showEditForm($id) {
		$edit_shipping_info = ShippingInformation::where('id', $id)->first();
        return view('shipping.edit', compact('edit_shipping_info'));
	}
	
	public function edit(Request $request, $id) {
		$shipping_info_edit = ShippingInformation::find($id);
		$shipping_info_edit->shipping_name = $request->shipping_name;
		$shipping_info_edit->post_number = $request->post_number;
		$shipping_info_edit->prefectures = $request->prefectures;
		$shipping_info_edit->address1 = $request->address1;
		$shipping_info_edit->address2 = $request->address2;
		$shipping_info_edit->phone_number = $request->phone_number;
		$shipping_info_edit->save();
		return redirect(route('shipping.index'))->with('flash_message', 'お届け先住所の編集が完了しました');;
	}

	public function destroy(Request $request, $id) {
		$shipping_info = ShippingInformation::find($id);
			if ($shipping_info->user_id == Auth::id()) {
				$shipping_info->delete();
			}
		return redirect(route('shipping.index'))->with('flash_message', 'お届け先住所の削除が完了しました');;
	}

	public function shippingSave(Request $request) {
		$shipping_id = $request->shipping_id;
		$shipping_target = ShippingInformation::find($shipping_id);
		return view('shipping.saved', compact('shipping_target'));
	}
}
