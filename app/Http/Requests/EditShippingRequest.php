<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditShippingRequest extends FormRequest
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
            'shipping_name' => 'required|string|max:50',
			'post_number' => 'required|numeric|digits:7',
			'prefectures' => 'required|string|max:10',
			'address1' => 'required|string|max:50',
            'address2' => ['required', 'string', 'max:50', Rule::unique('shipping_informations', 'address2')->where('post_number', $this->input('post_number'))->where('prefectures', $this->input('prefectures'))->where('address1', $this->input('address1'))->ignore($this->id)->whereNull('deleted_at')],
            'phone_number' => 'required|numeric|digits_between:8,11',
        ];
    }

    public function messages()
    {
        return [
            'shipping_name.required' => 'お届け先名は入力必須です',
            'shipping_name.string' => 'お届け先名は文字で入力して下さい。',
            'shipping_name.max:50' => 'お届け先名は最大５０文字まで入力して下さい。',
            'post_number.required' => '郵便番号は入力必須です',
            'post_number.digits:7' => '郵便番号は７桁で入力してください',
            'post_number.numeric' => '郵便番号は数値で入力してください',
            'post_number.max:8' => '郵便番号は8文字以下で入力してください',
            'prefectures.required' => '都道府県名は入力必須です',
            'prefectures.string' => '都道府県名は文字列で入力してください',
            'prefectures.max:10' => '都道府県名は10文字以下で入力してください',
            'address1.required' => '市区町村は入力必須です',
            'address1.string' => '市区町村は文字列で入力してください',
            'address1.max:50' => '市区町村は50文字以下で入力してください',
            'address2.required' => '番地以降の住所は入力必須です',
            'address2.string' => '番地以降の住所は文字列で入力してください',
            'address2.max:50' => '番地以降の住所は50文字以下で入力してください',
            'address2.unique' => 'この住所は既に登録されている為、編集不可です',
            'phone_number.required' => '電話番号は入力必須です',
            'phone_number.digits_between:8,11' => '電話番号は8桁から11桁の間で入力してください',
            'phone_number.numeric' => '電話番号は数値で入力してください',
        ];
    }

}
