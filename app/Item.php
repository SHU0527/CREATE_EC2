<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
	protected $fillable = ['name', 'description', 'price', 'stocks'];

	public function addItems($request) {
		$item = new Item;
		$item->name = $request->name;
		$item->description = $request->description;
		$item->price = $request->price;
		$item->stocks = $request->stocks;
		$item->save();
		return true;
	}
	public function editItem($request) {
		$item = $this->find($request->id);
		$item->name = $request->name;
		$item->description = $request->description;
		$item->stocks = $request->stocks;
		$item->save();
		return true;
	}
}
