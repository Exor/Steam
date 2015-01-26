<?php
use AbyssalArts\SteamApi\Containers\Item;
use AbyssalArts\SteamApi\Collection;

class MicrotransactionTest extends TestCase {

	public function setUp()
	{
		$this->microtxn = Steam::microtransaction(true); //Set up sandbox mode for testing
	}

	public function testGetUserInfo()
	{
		$user = $this->microtxn->GetUserInfo('76561197977832396');

		$this->assertEquals('OK', $user->result, json_encode($user));
		$this->assertEquals('OH', $user->params->state, json_encode($user));
		$this->assertEquals('US', $user->params->country, json_encode($user));
		$this->assertEquals('USD', $user->params->currency, json_encode($user));
		$this->assertEquals('Trusted', $user->params->status, json_encode($user));
	}

	public function testGetUserInfoWithBadSteamId()
	{
		$user = $this->microtxn->GetUserInfo('76561197');

		$this->assertEquals('Failure', $user->result, json_encode($user));
		$this->assertObjectHasAttribute('errorcode', $user->error, json_encode($user));
		$this->assertObjectHasAttribute('errordesc', $user->error, json_encode($user));
	}

	public function testInitTxn()
	{
		$steamId = '76561197977832396';
		$orderId = mt_rand(1000000000, mt_getrandmax()) . mt_rand(1000000000, mt_getrandmax()); //unique, arbitrary number generated by our system
		$appId = '215550'; //game id
		$itemCount = '1';
		$language = 'EN';
		$currency = 'USD';
		$item = new Item((object)['itemid'=>'12345', 'qty'=>'1', 'amount'=>'199', 'description'=>'Redhat', 'category'=>'Hats']);
		$items = new Collection();
		$items->add($item);

		$order = $this->microtxn->InitTxn($orderId, $steamId, $appId, $itemCount, $language, $currency, $items);

		$this->assertEquals('OK', $order->result, json_encode($order));
	}

	// public function testFinalizeTxn()
	// {
	// 	$orderId = '76561197977832396'; //unique, arbitrary number generated by our system
	// 	$appId = '215550'; //game id

	// 	$order = $this->microtxn->FinalizeTxn($orderId, $appId);

	// 	$this->assertEquals('OK', $order->result, json_encode($order));	
	// }

	// public function testQueryTxn()
	// {
	// 	$orderId = '76561197977832396'; //unique, arbitrary number generated by our system
	//  	$appId = '215550'; //game id
	//  	$transId = '374839';

	//  	$status = $this->microtxn->QueryTxn($appId, $orderId);
	//  	$this->assertEquals('OK', $status->result, json_encode($status));	
	// }

}