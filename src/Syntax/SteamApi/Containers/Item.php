<?php namespace Syntax\SteamApi\Containers;

class Item {
	public $itemId;

	public $quantity;

	public $amount;

	public $description;

	public $category;

	public function __construct($item)
	{
		$this->itemId 		= $order->itemid;
		$this->quantity 	= $order->qty;
		$this->amount 		= $order->amount;
		$this->description 	= $order->description;
		$this->category 	= $order->category;
	}
}