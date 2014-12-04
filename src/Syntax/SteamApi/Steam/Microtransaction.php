<?php namespace Syntax\SteamApi\Steam;

use Syntax\SteamApi\Client;

class Microtransaction extends Client {

	public function __construct()
	{
		parent::__construct();
		$this->interface = 'ISteamMicroTxn';
	}

	public function GetUserInfo($steamId, $ipAddress = null)
	{
		// Set up the api details
		$this->method     = __FUNCTION__;
		$this->version    = 'v0001';

		// Set up the arguments
		$arguments = [
			'steamid' => $steamId,
			'ipaddress' => $ipAddress
		];

		// Get the client
		$client = $this->setUpClient($arguments);

		return $client->response;
	}

	public function InitTxn($orderId, $steamId, $appId, $itemCount, $language, $currency, $usersession = client, $ipAddress = null, $items)
	{
		//TODO Verify this is a POST request

		// Set up the api details
		$this->method     = __FUNCTION__;
		$this->version    = 'v0002';

		// Set up the arguments
		$arguments = [
			'steamid' => $steamId,
			'ipaddress' => $ipAddress
		];
		for($i = 0; $i < $items->count; $i++)
		{
			$arguments['itemid['.$i.']'] = $items[$i]->itemId;
			$arguments['qty['.$i.']'] = $items[$i]->quantity;
			$arguments['amount['.$i.']'] = $items[$i]->amount;
			$arguments['description['.$i.']'] = $items[$i]->description;
			$arguments['category['.$i.']'] = $items[$i]->category;
		}

		// Get the client
		$client = $this->setUpClient($arguments);

		return $client->response;
	}
}