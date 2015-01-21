<?php namespace AbyssalArts\SteamApi\Containers;

class Item {
	public $itemId;

	public $quantity;

	public $amount;

	public $description;

	public $category;

	public function __construct($item)
	{
		$this->itemId 		= $item->itemid;
		$this->quantity 	= $item->qty;
		$this->amount 		= $item->amount;
		$this->description 	= $item->description;
		$this->category 	= $item->category;
	}
}