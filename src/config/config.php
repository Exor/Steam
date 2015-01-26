<?php

return array(

	/**
	 * You can get a steam API key from http://steamcommunity.com/dev/apikey
	 * Once you get your key, add it here.
	*/
	'steamApiKey' => 'YOUR-API-KEY',

	/**
	 * You can get a steam App Id from http://steamcommunity.com/
	 * Once you get your id, add it here.
	 * An App Id is necessary if your game uses microtransactions, web authentication, or Steam economy features
	*/
	'appId' => 'YOUR-APP-ID',

	/**
	 * If true, the microtransaction functions will hit the Steam test server.
	 * Microtransaction orders are also stored in a test database instead of production.
	 * Toggle this flag to false when your game goes live.
	*/
	'testEnvironment' => 'true',
);