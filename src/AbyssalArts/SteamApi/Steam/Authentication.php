<?php namespace AbyssalArts\SteamApi\Steam;

use AbyssalArts\SteamApi\Client;
use AbyssalArts\SteamApi\Exceptions\InvalidAppIdException;

class Authentication extends Client {

	protected $appId;

	public function __construct()
	{
		parent::__construct();
		$this->interface = 'ISteamUserAuth';

		//Get the App Id
		$appId = \Config::get('steam-api::appId');
		if ($appId == 'YOUR-APP-ID') {
			throw new Exceptions\InvalidAppIdException();
		}
		$this->appId = $appId;		
	}

	/**
	 * Retrieves a user’s purchasing info.
	 */
	public function AuthenticateUserTicket($ticket)
	{
		// Set up the api details
		$this->method     = __FUNCTION__;
		$this->version    = 'v0001';

		// Set up the arguments
		$arguments = [
			'appid' => $this->appId,
			'ticket' => $ticket
		];

		// Get the client
		$client = $this->setUpClient($arguments);

		return $client->response;
	}
}