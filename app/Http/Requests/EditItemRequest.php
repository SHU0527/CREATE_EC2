<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Item;
use Illuminate\Validation\Rule;


class EditItemRequest extends FormRequest
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
        $item = Item::find($this->id);
        return [
			'name' => ['required', 'string', 'max:100', Rule::unique('items', 'name')->ignore($this->id)->whereNull('deleted_at')],
			'description' => 'required|string|max:1000',
			'stocks' => 'required|numeric|min:0|max:99999',
            'image_name' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
		];
    }

    public function messages() {
		return [
			'name.required' => '商品名は入力必須です',
			'name.string' => '商品名は文字で入力して下さい。',
			'name.max:100' => '商品名は最大100文字まで入力して下さい。',
            'name.unique' => 'この商品名は既に存在しています',
			'description.required' => '商品説明は入力必須です',
			'description.string' => '商品説明は文字で入力してください',
			'description.max:1000' => '商品説明は1000文字まで入力してください',
			'stocks.required' => '在庫数は入力必須です',
			'stocks.numeric' => '在庫数は数値で入力してください',
            'stocks.min:0' => '在庫数は0個から入力してください',
			'stocks.max:99999' => '在庫数は50文字以下で入力してください',
			'image_name.file' => 'ファイル形式で選択してください',
            'image_name.image' => '画像形式のファイルを選択してください',
            'image_name.mimes' => '拡張子はjpeg,png,jpg,gifを選択してください',
            'image_name.max:2048' => '最大画像サイズは2048キロバイトまでを選択してください',
		];
	}
}
