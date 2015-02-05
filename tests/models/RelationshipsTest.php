<?php

class RelationshipsTest extends TestCase {

public function setUp()
{
	parent::setUp();

	//Create the user
	$this->user = new SteamApi_User();
	$this->user->steamid = '1234567890';
  	$this->assertTrue($this->user->save());

  	//Create the Order
	$this->order = new SteamApi_Order();
	$this->order->orderid = "01234567890123456789";
  	$this->order->transid = "01234567890123456789";
  	$this->order->steamid = $this->user->steamid;
  	$this->assertTrue($this->order->save());
}

public function tearDown()
{
	$users = SteamApi_User::all();
	foreach($users as $user) {$user->delete();}
}

public function testCanGetUserOrders()
{
	$orders = SteamApi_User::all()->first()->orders;
	$this->assertEquals($this->order->orderid, $orders->first()->orderid);
	$this->assertEquals($this->order->transid, $orders->first()->transid);
}

}