<?php namespace Syntax\SteamApi\Containers;

class Order {
	public $orderId;

	public $appId;

	public $language;

	public $currency;

	public $itemId;

	public $amount;

	public $itemDescription;

	public $itemCategory;

	public function __construct($order)
	{
		$this->orderId     		= $order->orderId;
		$this->appId    		= $order->appId;
		$this->language        	= $order->language;
		$this->currency 		= $order->currency;
		$this->itemId 			= $order->itemId;
		$this->amount 			= $order->amount;
		$this->itemDescription 	= $order->itemDescription;
		$this->itemCategory 	= $order->itemCategory;
	}
}