<?php

namespace App\Http\Controllers\Admin;
use App\Item;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\EditItemRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller {
	public function index() {
		$items = Item::all();
		return view('admin/item.index', compact('items'));
	}
	public function show($id) {
		$item = Item::find($id);
		if ($item) {
			return view('admin/item.show', compact('item'));
		} else {
			return redirect()->back()->with('flash_message', '不正なアクセスです');
		}
	}

	public function create() {
		return view('admin/item.create');
	}

	public function store(ItemRequest $request) {
		(new Item)->addItems($request);
		return redirect(route('admin.items.index'))->with('flash_message', '商品が追加されました');
	}
	public function edit($id) {
		$item = Item::find($id);
		if ($item) {
			return view('admin/item.edit', compact('item'));
		} else {
			return redirect()->back()->with('flash_message', '不正なアクセスです');
		}
	}

	public function update(EditItemRequest $request, $id) {
		(new Item)->editItem($request, $id);
		return redirect(route('admin.items.show', $id))->with('flash_message', '商品情報が変更されました');
	}
}
