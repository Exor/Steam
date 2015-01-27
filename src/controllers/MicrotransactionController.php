<?php namespace AbyssalArts\SteamApi\Controllers;

use AbyssalArts\SteamApi\Containers\Item;
use AbyssalArts\SteamApi\Collection;

class MicrotransactionController extends \Controller {

	public function StartMicrotransaction()
	{

		$microtxn = \Steam::microtransaction();

		$records = 1;
		//If order exists in the database, we need a new order id
		while ($records == 1)
		{
			$orderId = mt_rand(1000000000, mt_getrandmax()) + mt_rand(1000000000, mt_getrandmax());

			if (\Config::get('steam-api::testEnvironment'))
				{$records = \SteamApi_Order_Test::where('orderid', $orderId)->count();}
			else
				{$records = \SteamApi_Order::where('orderid', $orderId)->count();}
		}

		$steamId = \Input::get('steamid');

		$items_raw = \Input::get('items');
		//Convert the items list to JSON
		$items_json = json_decode($items_raw);
		$items = new Collection();
		//Convert the items Json to an item object and add each item to the items list
		foreach ($items_json as $item)
		{
			$item = new Item((object)['itemid'=>$item->{'itemid'}, 'qty'=>$item->{'qty'}, 'amount'=>$item->{'amount'}, 'description'=>$item->{'description'}, 'category'=>$item->{'category'}]);
			$items->add($item);
		}
		

		$itemCount = $items->count();


		$language = \Input::get('language');
		$currency = \Input::get('currency');
		
		//Call ISteamMicroTxn/InitTxn
		
		$response = $microtxn->InitTxn($orderId, $steamId, $itemCount, $language, $currency, $items);
		
		//Output
		if ($response->result == 'OK')
		{
			//success

			//Save data to the orders table
			if (\Config::get('steam-api::testEnvironment'))
				{$order = new \SteamApi_Order_Test;}
			else
				{$order = new \SteamApi_Order;}
			$order->orderid = $response->params->orderid;
			$order->steamid = $steamId;
			$order->transid = $response->params->transid;
			$order->save();

			return json_encode($response);
		}
		else
		{
			//failure
			return json_encode($response);//"Steam error code: " . $response->error->errorcode . "/n Error description: " . $response->error->errordesc;
		}
	}

	public function FinishMicrotransaction()
	{
		$microtxn = \Steam::microtransaction();

		$orderId = \Input::get('orderid');

		$response = $microtxn->FinalizeTxn($orderId);
		
		if ($response->result == 'OK')
		{
			//success

			//TODO: Grant the user the items they bought??
			return json_encode($response);
		}
		else
		{
			//failure
			return json_encode($response);//"Steam error code: " . $response->error->errorcode . "/n Error description: " . $response->error->errordesc;
		}		
	}
}