<?php namespace AbyssalArts\SteamApi\Controllers;

use AbyssalArts\SteamApi\Containers\Item;
use AbyssalArts\SteamApi\Collection;

class MicrotransactionController extends \Controller {

	public function StartMicrotransaction()
	{

		$microtxn = \Steam::microtransaction();

		// create an order ID. If order ID already exists in the database, we need a new order id
		$records = 1;
		while ($records == 1)
		{
			$orderId = mt_rand(1000000000, mt_getrandmax()) + mt_rand(1000000000, mt_getrandmax());

			if (\Config::get('steam-api::testEnvironment'))
				{$records = \SteamApi_Order_Test::where('orderid', $orderId)->count();}
			else
				{$records = \SteamApi_Order::where('orderid', $orderId)->count();}
		}

		//Get the order and set up inputs
		$order = \Input::get('order');
		$order = json_decode($order);
		$steamId = $order->steamid;
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
			if (\Config::get('steam-api::testEnvironment'))
				{$steamOrder = new \SteamApi_Order_Test;}
			else
				{$steamOrder = new \SteamApi_Order;}
			$steamOrder->orderid = $response->params->orderid;
			$steamOrder->steamid = $steamId;
			$steamOrder->transid = $response->params->transid;
			$steamOrder->save();

			//Add order ID and transaction ID to the object
			$order->response = $response->result;
			$order->transid = $response->params->transid;
			$order->orderid = $response->params->orderid;

			//Return the object
			$json = $this->RemoveLeadingSlash(json_encode($order));
			return json_encode($json);
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

			//TODO: Grant the user the items they bought??
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

	private function RemoveLeadingSlash($json)
	{
		if (substr($json, 0, 1) == '\\')
		{
			return substr($json, 1);
		}
		return $json;
	}
}