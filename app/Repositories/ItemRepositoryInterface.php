<?php

namespace App\Repositories;

interface ItemDataAccessRepositoryInterface
{
    /**
     * Nameで1レコードを取得S
     *
     * @var string $name
     * @return object
     */
	public function getAll();

	public function getDetail($id);
}

?>
