<?php

namespace App\Http\Controllers\Admin;
use App\Item;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index()
    {
		$items = Item::all();
		return view('admin/item.index', compact('items'));
    }
    public function show($id)
    {
		$item = Item::find($id);
		return view('admin/item.show', compact('item'));
    }

    public function create()
	{
		return view('admin/item.create');
    }

    public function store(ItemRequest $request)
	{
		(new Item)->addItems($request);
		return redirect(route('items.index'))->with('flash_message', '商品が追加されました');
    }
    public function edit($id)
	{
		$item = Item::find($id);
		if ($item) {
			return view('admin/item.edit', compact('item'));
		} else {
			return redirect('admin/items')->with('error', '商品が存在しません');
		}
	}

    public function update(ItemRequest $request, $id)
	{
		(new Item)->editItem($request, $id);
		return redirect(route('items.show', $id))->with('flash_message', '商品情報が変更されました');
	}

    public function destroy($id)
    {
        //
    }
}
