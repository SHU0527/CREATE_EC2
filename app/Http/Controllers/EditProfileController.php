<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UpdateUserInformationRequest;
use Illuminate\Support\Facades\Auth;
use App\EmailReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Mail;
use Carbon\Carbon;





class EditProfileController extends Controller {
	public function index() {
		$edit_user_info = Auth::user();
		return view('profile.edit', compact('edit_user_info'));
	}

	public function store(UpdateUserInformationRequest $request) {
		$edit_user_info = User::find($request->user_id);
		$check_email = User::where('email', $request->email)->first();
		$new_email = $request->input('email');
		if ($new_email != Auth::user()->email) {
			$token = hash_hmac(
				'sha256',
				str_random(40).$new_email,
				env('APP_KEY')
			);
			$change_email = new EmailReset;
			$change_email->user_id = Auth::id();
			$change_email->new_email = $new_email;
			$change_email->token = $token;
			$change_email->save();
			Mail::send('mail.changeEmail', ['url' =>
				"https://procir-study.site/maegawa207/laravel5.5/public/user/userEmailUpdate/?token={$token}"],
				function ($message) use ($change_email) {
					$message->from('hello@app.com', 'Your Application');
					$message->to($change_email->new_email)->subject('Your Reminder!');
				});
			$edit_user_info->name = $request->user_name;
			$edit_user_info->password = bcrypt($request->get('new_password'));
			$edit_user_info->save();
			return redirect()->back()->with('flash_message', '送信したメールアドレスのURLをクリックしてアカウント情報を変更してください');
		} else {
			$edit_user_info->name = $request->user_name;
			$edit_user_info->password = bcrypt($request->get('new_password'));
			$edit_user_info->save();
			return redirect()->back()->with('flash_message', 'アカウント情報を変更しました');
		}
	}

	public function userEmailUpdate(Request $request) {
		$token = $request->input('token');
		// トークン照合
		$email_change = DB::table('email_resets')->where('token', '=', $token)->first();
		$created_token_time = new Carbon($email_change->created_at);
		$now_time = Carbon::now();
		$diff_time =$created_token_time->diffInMinutes($now_time);
		if (!empty($email_change) && $diff_time <= 30) {
			// 照合一致で一時保存DBのメールアドレスをDBメールアドレスに上書
			$user = User::find($email_change->user_id);
			$user->email = $email_change->new_email;
			$user->save();
			// 一時保存DBレコード削除
			DB::table('email_resets')->where('token', '=', $token) ->delete();
			return redirect()->back()->with('flash_message', 'アカウント情報を変更しました。');
		} else {
			return redirect()->back()->with('flash_message', '無効のURLです');
		}
	}
}
