<?php namespace AbyssalArts\SteamApi\Steam;

use AbyssalArts\SteamApi\Client;
use AbyssalArts\SteamApi\Exceptions\InvalidAppIdException;
use AbyssalArts\SteamApi\Exceptions\ApiArgumentRequired;

/**
 * This class implements the functions as documented on 
 * https://partner.steamgames.com/documentation/MicroTxn
 */
class Microtransaction extends Client {

	protected $appId;

	public function __construct()
	{
		parent::__construct();

		//Set the Steam environment URL
		if (\Config::get('steam-api::testEnvironment'))
			{$this->interface = 'ISteamMicroTxnSandbox';}
		else
			{$this->interface = 'ISteamMicroTxn';}

		//Get the App Id
		$appId = \Config::get('steam-api::appId');
		if ($appId == 'YOUR-APP-ID') {
			throw new InvalidAppIdException();
		}
		$this->appId = $appId;
	}

	/**
	 * Retrieves a user’s purchasing info.
	 */
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

	/**
	 * Creates a new purchase.
	 * Send the order information along with the SteamID to seed the transaction on Steam.
	 */
	public function InitTxn($orderId, $steamId, $itemCount, $language, $currency, $items, $usersession = 'client', $ipAddress = null)
	{
		// Set up the api details
		$this->method     = __FUNCTION__;
		$this->version    = 'v0002';
		$this->httpVerb   = 'POST';

		// Set up the arguments
		$arguments = [
			'orderid' 	=> $orderId,
			'steamid' 	=> $steamId,
			'appid' 	=> $this->appId,
			'itemcount'	=> $itemCount,
			'language'	=> $language,
			'currency'	=> $currency,
			'usersession' => $usersession,
			'ipaddress' => $ipAddress
		];

		//Set the item array
		for($i = 0; $i < $items->count(); $i++)
		{
			$item = [
				'itemid['.$i.']' => $items[$i]->itemId,
				'qty['.$i.']' 	=> $items[$i]->quantity,
				'amount['.$i.']' => $items[$i]->amount,
				'description['.$i.']' => $items[$i]->description,
				'category['.$i.']' => $items[$i]->category
			];
			$arguments = array_merge($arguments, $item);
		}

		// Get the client
		$client = $this->setUpClient($arguments);

		return $client->response;
	}

	/**
	 * Completes a purchase that was created by the InitTxn API.
	 */
	public function FinalizeTxn($orderId)
	{
		// Set up the api details
		$this->method     = __FUNCTION__;
		$this->version    = 'v0001';
		$this->httpVerb    = 'POST';

		// Set up the arguments
		$arguments = [
			'orderid' => $orderId,
			'appid' => $this->appId
		];

		// Get the client
		$client = $this->setUpClient($arguments);

		return $client->response;
	}

	/**
	 * Query the status of an order.
	 * Must specify an orderId or transactionId
	 */
	public function QueryTxn($orderId = null, $transactionId = null)
	{
		// Set up the api details
		$this->method     = __FUNCTION__;
		$this->version    = 'v0001';

		// Set up the arguments
		$arguments = [
			'appid' => $this->appId,
		];
		if (!is_null($orderId)) { $arguments['orderid'] = $orderId; }
		else if (!is_null($transactionId)) { $arguments['transid'] = $transactionId; }
		else throw new ApiArgumentRequired;

		// Get the client
		$client = $this->setUpClient($arguments);

		return $client->response;
	}

	/**
	 * Refund a purchase.
	 * Refunds can only be made for the full value of the original order.
	 */
	public function RefundTxn($orderId)
	{
		//TODO Verify this is a POST request

		// Set up the api details
		$this->method     = __FUNCTION__;
		$this->version    = 'v0001';
		$this->httpVerb    = 'POST';

		// Set up the arguments
		$arguments = [
			'orderid' => $orderId,
			'appid' => $this->appId
		];

		// Get the client
		$client = $this->setUpClient($arguments);

		return $client->response;
	}

	/**
	 * Steam offers transaction reports that can be downloaded for reconciliation purposes. 
	 * These reports show detailed information about each transaction that affects the settlement of funds into your accounts.
	 */
	public function GetReport($type, $time, $maxResults)
	{
		// Set up the api details
		$this->method     = __FUNCTION__;
		$this->version    = 'v0002';

		// Set up the arguments
		$arguments = [
			'appid' => $this->appId,
			'type' => $type,
			'time' => $time,
			'maxresults' => $maxResults
		];

		// Get the client
		$client = $this->setUpClient($arguments);

		return $client->response;
	}
}