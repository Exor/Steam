<?php namespace AbyssalArts\SteamApi\Steam;

use AbyssalArts\SteamApi\Client;

class Authentication extends Client {

	public function __construct()
	{
		parent::__construct();
		$this->interface = 'ISteamUserAuth';
	}

	/**
	 * Retrieves a user’s purchasing info.
	 */
	public function AuthenticateUserTicket($appId, $ticket)
	{
		// Set up the api details
		$this->method     = __FUNCTION__;
		$this->version    = 'v0001';

		// Set up the arguments
		$arguments = [
			'appid' => $appId,
			'ticket' => $ticket
		];

		// Get the client
		$client = $this->setUpClient($arguments);

		return $client->response;
	}
}