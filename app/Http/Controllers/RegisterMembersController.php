<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShippingInformation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class RegisterMembersController extends Controller {
	public function index() {
		$register_members = ShippingInformation::all();
		$members = $register_members->unique('user_id');
		return view('member.index', compact('members'));
	}

	public function detail($id) {
		$members_detail = ShippingInformation::where('user_id', $id)->get();
		$user_info = User::find($id);
		if (!isset($user_info)) {
			return redirect()->back()->with('flash_message', '不正なアクセスです');
		}
		return view('member.detail', compact('members_detail', 'user_info'));
	}
}
