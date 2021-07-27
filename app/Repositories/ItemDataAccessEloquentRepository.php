<?php

namespace App\Repositories;
use App\Item;

class ItemDataAccessEloquentRepository implements ItemDataAccessRepositoryInterface
{

	public function getAll()
	{
		$items = Item::all();
		return $items;
	}
	public function getDetail($id)
	{
		$item = Item::find($id);
		return $item;
	}
}

?>
