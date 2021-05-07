<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Item extends Model {
	protected $fillable = ['name', 'description', 'price', 'stocks'];

	public function addItems($request) {
		$item = new Item;
		$item->name = $request->name;
		$item->description = $request->description;
		$item->price = $request->price;
		$item->stocks = $request->stocks;
		if (!empty($request->file('image_name'))) {
			$path = $request->file('image_name')->store('public/img');
			$item->image_name = basename($path);
		}
		$item->save();
		return true;
	}
	public function editItem($request, int $id) {
		$item = $this->find($id);
		$item->name = $request->name;
		$item->description = $request->description;
		$item->stocks = $request->stocks;
		if (!empty($request->file('image_name'))) {
			$path = $request->file('image_name')->store('public/img');
			$item->image_name = basename($path);
		}	
		$item->save();
		return true;
	}
}
