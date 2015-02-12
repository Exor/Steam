<?php namespace AbyssalArts\SteamApi\Controllers;

use AbyssalArts\SteamApi\Containers\Item;
use AbyssalArts\SteamApi\Collection;

class MicrotransactionController extends \Controller {

	public function StartMicrotransaction()
	{
		//Get the order and verify it is legit
		$order = \Input::get('order');
		$key = \Input::get('key');
		if ($key != $this->ComputeHashKey($order))
			{ return json_encode(['response' => 'Failure', 'errorcode' => '501', 'errordesc' => 'Invalid key']); }

		//Set up the microtransaction
		$microtxn = \Steam::microtransaction();

		// create an order ID. If order ID already exists in the database, we need a new order id
		$records = 1;
		while ($records == 1)
		{
			$orderId = mt_rand(1000000000, mt_getrandmax()) + mt_rand(1000000000, mt_getrandmax());

			$records = \SteamApi_Order::where('orderid', $orderId)->count();
		}

		$order = json_decode($order);
		$steamId = $order->steamid;
		//Since this will likely be the first entrypoint for many users check to see if there is an existing entry, otherwise create one.
		\SteamApi_User::firstOrCreate(array('steamid' => $steamId));
		$language = $order->language;
		$currency = $order->currency;
		
		//Add the items to an item object
		$items_json = $order->items;
		$items = new Collection();
		foreach ($items_json as $item)
		{
			$item = new Item((object)['itemid'=>$item->{'itemid'}, 'qty'=>$item->{'qty'}, 'amount'=>$item->{'amount'}, 'description'=>$item->{'description'}, 'category'=>$item->{'category'}]);
			$items->add($item);
		}

		$itemCount = $items->count();

		
		//Call ISteamMicroTxn/InitTxn
		$response = $microtxn->InitTxn($orderId, $steamId, $itemCount, $language, $currency, $items);
		
		//Output
		if ($response->result == 'OK')
		{
			//success

			//Save data to the orders table
			$steamOrder = new \SteamApi_Order();
			$steamOrder->orderid = $response->params->orderid;
			$steamOrder->steamid = $steamId;
			$steamOrder->transid = $response->params->transid;
			$steamOrder->save();

			//For some reason we need to pull this out of the database for the attach() to work properly
			$Order = \SteamApi_Order::find($response->params->orderid);
			//Add the items to the order just for reference
			foreach ($items as $item)
			{
				$Order->items()->attach($item->itemId);
			}

			//Add order ID and transaction ID to the order to be returned
			$order->response = $response->result;
			$order->transid = $response->params->transid;
			$order->orderid = $response->params->orderid;

			//Return the object
			return json_encode($order);
		}
		else if ($response->result == "Failure")
		{
			//failure
			$order->response = $response->result;
			$order->errorcode = $response->error->errorcode;
			$order->errordesc = $response->error->errordesc;
			return json_encode($order);
		}
		return json_encode($response);
	}

	public function FinishMicrotransaction()
	{
		$microtxn = \Steam::microtransaction();

		$orderId = \Input::get('orderid');

		$response = $microtxn->FinalizeTxn($orderId);
		
		if ($response->result == 'OK')
		{
			//success

			//Grant the user the items they bought
			$user = \SteamApi_Order::find($orderId)->user;
			$items = \SteamApi_Order::find($orderId)->items;
			foreach ($items as $item)
			{
				$user->items()->attach($item->uuid);
			}

			return json_encode(array('response' => $response->result));
		}
		else if ($response->result == 'Failure')
		{
			//failure
			return json_encode(array('response' => $response->result, 'errorcode' => $response->error->errorcode, 'errordesc' => $response->error->errordesc));
		}		
		return json_encode($response);
	}

	public function RefundMicrotransaction()
	{
		$microtxn = \Steam::microtransaction();

		$orderId = \Input::get('orderid');

		$response = $microtxn->RefundTxn($orderId);
		
		if ($response->result == 'OK')
		{
			//success
			return json_encode(array('response' => $response->result));
		}
		else if ($response->result == 'Failure')
		{
			//failure
			return json_encode(array('response' => $response->result, 'errorcode' => $response->error->errorcode, 'errordesc' => $response->error->errordesc));
		}		
		return json_encode($response);
	}

	public function GetMicrotransactionReport()
	{
		$microtxn = \Steam::microtransaction();

		$type = \Input::get('type');
		$time = \Input::get('time');
		$maxResults = \Input::get('maxResults');

		$response = $microtxn->GetReport($type, $time, $maxResults);
		
		if ($response->result == 'OK')
		{
			//success
			return json_encode($response);
		}
		else if ($response->result == 'Failure')
		{
			//failure
			return json_encode(array('response' => $response->result, 'errorcode' => $response->error->errorcode, 'errordesc' => $response->error->errordesc));
		}		
		return json_encode($response);
	}

	private function ComputeHashKey($string)
	{
		return hash(\Config::get('steam-api::hashingAlgorithm'), \Config::get('steam-api::secretKey') . $string);
	}
}