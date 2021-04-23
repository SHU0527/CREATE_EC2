<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserInformationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name' => 'required|string|max:20',
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if(!(\Hash::check($value, \Auth::user()->password))) {
                      return $fail('現在のパスワードを正しく入力してください');
                    }
                },
            ],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->id)],
            'new_password' => 'required|string|min:6|confirmed|different:current_password',
        ];
    }

    public function messages() {
		return [
            'user_name.required' => 'ユーザー名は入力必須です',
            'user_name.string' => 'ユーザー名は文字列で入力してください',
            'user_name.max:20' => 'ユーザー名は20文字以下で入力してください',
			'new_password.required' => '新しいパスワードは入力必須です',
			'new_password.string' => '新しいパスワードは文字で入力して下さい。',
			'new_password.min:6' => '新しいパスワードは６文字以上で入力してください',
			'new_password.confirmed' => '新しいパスワードは確認用のパスワードと一致させてください',
			'new_password.different:current_password' => '新しいパスワードは現在設定しているパスワードと異なる値を入力してください',
		];
	}
}
