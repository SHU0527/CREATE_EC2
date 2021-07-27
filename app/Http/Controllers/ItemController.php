<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
//use App\Repositories\ItemEroquentRepository;
use App\Repositories\ItemDataAccessRepositoryInterface AS ItemDataAccess;


class ItemController extends Controller
{
	protected $item;

	public function __construct(ItemDataAccess $item_data_access) {
		$this->item = $item_data_access;
	}
	public function index() {
		$items = $this->item->getAll();
		return view('item.index', compact('items'));
	}
	public function detail($id) {
		$detail = $this->item->getDetail($id);
		return view('item.detail', compact('detail'));
	}
}
