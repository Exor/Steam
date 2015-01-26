<?php namespace AbyssalArts\SteamApi\Exceptions;

class InvalidAppIdException extends \Exception {

	public function __construct()
	{
		parent::__construct(sprintf('You must use a valid Application Id to connect to Steam.'));
	}
}