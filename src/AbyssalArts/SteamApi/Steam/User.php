<?php namespace AbyssalArts\SteamApi\Steam;

use AbyssalArts\SteamApi\Client;
use AbyssalArts\SteamApi\Collection;
use AbyssalArts\SteamApi\Containers\Player as PlayerContainer;

class User extends Client {

	public function __construct($steamId)
	{
		parent::__construct();
		$this->interface = 'ISteamUser';
		$this->steamId   = $steamId;
	}

	public function GetPlayerSummaries($steamId = null)
	{
		// Set up the api details
		$this->method  = __FUNCTION__;
		$this->version = 'v0002';

		if ($steamId == null) {
			$steamId = $this->steamId;
		}

		// Set up the arguments
		$arguments = [
			'steamids' => $steamId
		];

		// Get the client
		$client = $this->setUpClient($arguments)->response;

		// Clean up the players
		$players = $this->convertToObjects($client->players);

		return $players;
	}

	public function GetFriendList($relationship = 'all')
	{
		// Set up the api details
		$this->method  = __FUNCTION__;
		$this->version = 'v0001';

		// Set up the arguments
		$arguments = [
			'steamid' => $this->steamId,
			'relationship' => $relationship
		];

		// Get the client
		$client = $this->setUpClient($arguments)->friendslist;

		// Fill out the friends list
		$steamIds = array();

		foreach ($client->friends as $friend) {
			$steamIds[] = $friend->steamid;
		}

		$friends = $this->GetPlayerSummaries(implode(',', $steamIds));

		// Clean up the friends
		//$friends = $this->convertToObjects($client->friends);		

		return $friends;
	}

	protected function convertToObjects($players)
	{
		$cleanedPlayers = new Collection;

		foreach ($players as $player) {
			$cleanedPlayers->add(new PlayerContainer($player));
		}

		return $cleanedPlayers;
	}
}