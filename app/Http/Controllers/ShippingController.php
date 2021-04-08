<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShippingInformation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;




class ShippingController extends Controller
{
    public function index() {
		$shippings = ShippingInformation::where('user_id', Auth::id())->get();
		$shipping_id = Auth::user()->shipping_id;
        return view('shipping.index', compact('shippings', 'shipping_id'));
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
		DB::beginTransaction();
        try {
			$shipping_information->save();
            $shipping_id = $shipping_information->id;
            $user = User::find(Auth::id());
            $user->shipping_id = $shipping_id;
			$user->save();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
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

	public function destroy(Request $request) {
		$shipping_info = ShippingInformation::find($request->shipping_id);
		if ($shipping_info->user_id == Auth::id()) {
			$shipping_info->delete();
			$user = User::find(Auth::id());
			if ($user->shipping_id == $request->shipping_id) {
				$user->shipping_id = NULL;
				$user->save();
			}
			return redirect(route('shipping.index'))->with('flash_message', 'お届け先住所の削除が完了しました');
		} else {
			return redirect(route('shipping.index'))->with('flash_message', 'この住所は登録できません');
		}
	}

	public function shippingSave(Request $request) {
		$shipping_id = $request->shipping_id;
		$shipping_target = ShippingInformation::find($shipping_id);
		return view('shipping.saved', compact('shipping_target'));
	}
}
