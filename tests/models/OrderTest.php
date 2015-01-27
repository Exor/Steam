<?php

class OrderTest extends TestCase {

public function setUp()
{
	parent::setUp();
	$this->order = new SteamApi_Order_Test();
	$this->order->orderid = "01234567890123456789";
  	$this->order->transid = "01234567890123456789";
  	$this->order->steamid = "01234567890123456789";
}

public function tearDown()
{
	$orders = SteamApi_Order_Test::all();
	foreach($orders as $order) {$order->delete();}
}

public function testCanCreateOrderWithValidParameters()
{
  	$this->assertTrue($this->order->save());
}

}