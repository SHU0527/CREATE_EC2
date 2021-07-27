<?php

namespace App\Repositories;
use DB;

class ItemDataAccessQBRepository implements ItemDataAccessRepositoryInterface
{
	protected $table = 'items';

	public function getAll()
	{
		return DB::table($this->table)->get();
	}
	public function getDetail($id)
	{
		return DB::table($this->table)->where('id', $id)->first();
	}
}

?>
