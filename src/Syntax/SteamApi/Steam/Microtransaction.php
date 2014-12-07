<?php namespace Syntax\SteamApi\Steam;

use Syntax\SteamApi\Client;
use Syntax\SteamApi\Exceptions\ApiArgumentRequired;

/**
 * This class implements the functions as documented on 
 * https://partner.steamgames.com/documentation/MicroTxn
 */
class Microtransaction extends Client {

	public function __construct()
	{
		parent::__construct();
		$this->interface = 'ISteamMicroTxn';
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
	public function InitTxn($orderId, $steamId, $appId, $itemCount, $language, $currency, $usersession = client, $ipAddress = null, $items)
	{
		// Set up the api details
		$this->method     = __FUNCTION__;
		$this->version    = 'v0002';
		$this->httpVerb   = 'POST';

		// Set up the arguments
		$arguments = [
			'steamid' => $steamId,
			'ipaddress' => $ipAddress
		];

		//TODO Verify this works
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

	/**
	 * Completes a purchase that was created by the InitTxn API.
	 */
	public function FinalizeTxn($orderId, $appId)
	{
		// Set up the api details
		$this->method     = __FUNCTION__;
		$this->version    = 'v0001';
		$this->httpVerb    = 'POST';

		// Set up the arguments
		$arguments = [
			'orderid' => $orderId,
			'appid' => $appId
		];

		// Get the client
		$client = $this->setUpClient($arguments);

		return $client->response;
	}

	/**
	 * Query the status of an order.
	 * Must specify an orderId or transactionId
	 */
	public function QueryTxn($appId, $orderId = null, $transactionId = null)
	{
		// Set up the api details
		$this->method     = __FUNCTION__;
		$this->version    = 'v0001';

		// Set up the arguments
		$arguments = [
			'appid' => $appId,
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
	public function RefundTxn($orderId, $appId)
	{
		//TODO Verify this is a POST request

		// Set up the api details
		$this->method     = __FUNCTION__;
		$this->version    = 'v0001';
		$this->httpVerb    = 'POST';

		// Set up the arguments
		$arguments = [
			'orderid' => $orderId,
			'appid' => $appId
		];

		// Get the client
		$client = $this->setUpClient($arguments);

		return $client->response;
	}

	/**
	 * Steam offers transaction reports that can be downloaded for reconciliation purposes. 
	 * These reports show detailed information about each transaction that affects the settlement of funds into your accounts.
	 */
	public function GetReport($appId, $type, $time, $maxResults)
	{
		// Set up the api details
		$this->method     = __FUNCTION__;
		$this->version    = 'v0002';

		// Set up the arguments
		$arguments = [
			'appid' => $appId,
			'type' => $type,
			'time' => $time,
			'maxresults' => $maxResults
		];

		// Get the client
		$client = $this->setUpClient($arguments);

		return $client->response;
	}
}