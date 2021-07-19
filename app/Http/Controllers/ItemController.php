<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Repositories\ItemEroquentRepository;

class ItemController extends Controller
{
	protected $item_repository;

	public function __construct(ItemEroquentRepository $item_repository) {
		$this->item_repository = $item_repository;
	}
	public function index() {
		
		$items = $this->item_repository->getItems();
		return view('item.index', compact('items'));
		
	}
	public function detail($id) {
		$detail = $this->item_repository->getDetails($id);
		return view('item.detail', compact('detail'));
	}
}
