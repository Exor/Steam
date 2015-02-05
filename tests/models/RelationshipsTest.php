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

  	//Create an Item
  	$this->item = new SteamApi_Item();
  	$this->item->uuid 		= '55555555555555';
	$this->item->name  		= 'Red Hat';
	$this->item->description= 'A silly red hat.';
	$this->item->price  	= '199';
	$this->item->version  	= '1.005';
	$this->assertTrue($this->item->save());

	//Add the item to the order
	$this->order->items()->attach($this->item->uuid);

	//Give the user an item
	$this->user->items()->attach($this->item->uuid);
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

	$this->assertEquals('1234567890', $this->order->user->steamid);
}

public function testCanGetOrderItems()
{
	//echo json_encode(DB::table('steamapi_items_orders')->get());
	$items = $this->order->items;
	$this->assertEquals($this->item->uuid, $items->first()->uuid);

	$orders = $this->item->orders;
	$this->assertEquals($this->order->orderid, $orders->first()->orderid);

	$order = SteamApi_Order::find($this->order->orderid);
	$this->assertEquals($order->items->first()->name, $this->item->name);
}

public function testCanGetUserItems()
{
	//echo json_encode(DB::table('steamapi_items_orders')->get());
	$items = $this->user->items;
	$this->assertEquals($this->item->uuid, $items->first()->uuid);

	$users = $this->item->users;
	$this->assertEquals($this->user->steamid, $users->first()->steamid);
}

}