<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;
use App\Item;

class ItemRequest extends FormRequest
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
			'name' => 'required|string|max:100',
			'description' => 'required|string|max:1000',
			'price' => 'sometimes|required|integer|min:0|max:999999999',
			'stocks' => 'required|integer|min:0|max:99999',
		];
    }
}
