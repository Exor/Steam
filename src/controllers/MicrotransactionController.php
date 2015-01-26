<?php namespace AbyssalArts\SteamApi\Controllers;

class MicrotransactionController extends \Controller {

	public function StartMicrotransaction()
	{
		$microtxn = \Steam::microtransaction();

		$exists = true;
		//If order exists in the database, we need a new order id
		while (!is_null($exists))
		{
			$orderId = mt_rand(1000000000, mt_getrandmax()) . mt_rand(1000000000, mt_getrandmax());
			if (\Config::get('steam-api::testEnvironment'))
				{$exists = \SteamApi_Order_Test::where('orderid', '=', $orderId);}
			else
				{$exists = \SteamApi_Order::where('orderid', '=', $orderId);}
		}

		$appId = \Config::get('steam-api::appId');
		$steamId = \Input::get('steamid');

		$items_raw = \Input::get('items');
		//Convert the items list to JSON
		$items_json = json_decode($items_raw);
		//Convert the items Json to an item object
		$item = new \Item((object)['itemid'=>$items_json->{'itemid'}, 'qty'=>$items_json->{'qty'}, 'amount'=>$items_json->{'amount'}, 'description'=>$items_json->{'description'}, 'category'=>$items_json->{'category'}]);
		//add each item to the items list
		$items = new \Collection();
		$items->add($item);

		$itemCount = $items->count();


		$language = \Input::get('language');
		$currency = \Input::get('currency');
		
		//Call ISteamMicroTxn/InitTxn
		
		$response = $microtxn->InitTxn($orderId, $steamId, $appId, $itemCount, $language, $currency, $items);
		
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
			return "Steam error code: " . $response->error->errorcode . "/n Error description: " . $response->error->errordesc;
		}
	}

	public function FinishMicrotransaction()
	{
		$microtxn = \Steam::microtransaction();

		$appId = \Config::get('steam-api::appId');
		$orderId = \Input::get('orderid');

		$response = $microtxn->FinalizeTxn($orderId, $appId);
		
		if ($response->result == 'OK')
		{
			//success

			//TODO: Grant the user the items they bought??
			return json_encode($response);
		}
		else
		{
			//failure
			return "Steam error code: " . $response->error->errorcode . "/n Error description: " . $response->error->errordesc;
		}		
	}
}