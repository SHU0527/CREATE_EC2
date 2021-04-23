<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UpdateUserInformationRequest;
use Illuminate\Support\Facades\Auth;


class EditProfileController extends Controller {
    public function index() {
        $edit_user_info = User::find(Auth::id());
        return view('profile.edit', compact('edit_user_info'));
    }

    public function store(UpdateUserInformationRequest $request) {
        $user_id = $request->id;
        $edit_user_info = User::find($user_id);
        $edit_user_info->name = $request->user_name;
        $edit_user_info->email = $request->email;
        $edit_user_info->password = bcrypt($request->get('new_password'));
        $edit_user_info->save();
        return redirect()->back()->with('flash_message', 'アカウント情報を変更しました。');
    }
}
