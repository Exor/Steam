<?php namespace Syntax\SteamApi\Controllers;

class SteamSupportToolController extends \Controller {

	public function ContextCommand()
	{
		$steamId = Input::get('steamid');
		$contextId = Input::get('contextid');
		$actorId = Input::get('actorid');
		$command = Input::get('command');
		$assetId = Input::get('assetid'); //Make Optional
		$arguments = Input::get('arguments');

		//Output
		App::abort(404);
	}

	public function GetUserHistory()
	{
		//Parameters
		$appId = Input::get('appid');
		$steamId = Input::get('steamid');
		$contextId = Input::get('contextid');
		$startTime = Input::get('starttime');
		$endTime = Input::get('endtime');

		//Retrieve the user's audit records within the time period

		//Output
		App::abort(404);
	}

	public function GetHistoryCommandDetails()
	{
		//Parameters
		$appId = Input::get('appid');
		$steamId = Input::get('steamid');
		$contextId = Input::get('contextid');
		$command = Input::get('command');
		$arguments = Input::get('arguments');

		//Output
		App::abort(404);
	}

	public function HistoryExecuteCommands()
	{
		//Parameters
		$appId = Input::get('appid');
		$steamId = Input::get('steamid');
		$contextId = Input::get('contextid');
		$actorId = Input::get('actorid');
		//command#
		//id#
		//argument#
		$command = Input::get('command');
		$arguments = Input::get('arguments');

		//Output
		App::abort(404);
	}

	public function SupportGetAssetHistory()
	{
		$appId = Input::get('appid');
		$contextId = Input::get('contextid');
		$assetId = Input::get('assetid');

		//Output
		App::abort(404);
	}
}