<?php

namespace App\Http\Controllers\Admin;
use App\Item;
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

    public function store(Request $request)
	{
		$item = new Item;
		$validatedData = $request->validate([
			'name' => 'required|string|max:100',
			'description' => 'required|string|max:1000',
			'price' => 'required|integer|min:0|max:999999999',
			'stocks' => 'required|integer|min:0|max:99999',
		]);
		$item->name = $request->name;
		$item->description = $request->description;
		$item->price = $request->price;
		$item->stocks = $request->stocks;
		$item->save();
		return redirect()->route('items.index');
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

    public function update(Request $request, $id)
	{
		$item = Item::find($id);
		$validatedData = $request->validate([
			'name' => 'required|string|max:100',
			'description' => 'required|string|max:1000',
			'stocks' => 'required|integer|min:0|max:99999',
		]);
		$item->name = $request->name;
		$item->description = $request->description;
		$item->stocks = $request->stocks;
		$item->save();
		return redirect()->route('items.show', $id);
	}

    public function destroy($id)
    {
        //
    }
}
