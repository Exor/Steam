<?php namespace AbyssalArts\SteamApi\Containers;

use AbyssalArts\SteamApi\Collection;

class Order {
	public $orderId;

	public $transactionId;

	public $steamId;

	public $status;

	public $currency;

	public $time

	public $country

	public $usState

	public $items


	public function __construct($order)
	{
		$this->orderId     		= $order->orderid;
		$this->transactionId    = $order->transid;
		$this->steamId     		= $order->steamid;
		$this->status     		= $order->status;
		$this->currency 		= $order->currency;
		$this->time 			= $order->time;
		$this->country 			= $order->country;
		$this->usState 			= $order->usstate;
		$this->items 			= new Collection($order->items);

	}
}