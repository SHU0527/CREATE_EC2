<?php

namespace App\Repositories;

use App\Item;


class ItemEroquentRepository {
	public function getItems() {
		$items = Item::all();
		return $items;
	}
	public function getDetails($id) {
		$item = Item::find($id);
		return $item;
	}
}
