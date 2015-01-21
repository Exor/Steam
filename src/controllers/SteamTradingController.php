<?php namespace AbyssalArts\SteamApi\Controllers;

class SteamTradingController extends \Controller {

	public function GetContexts()
	{
		//Parameters
		$appId = Input::get('appid');
		$steamId = Input::get('steamid');
		$parent = Input::get('parent');
		$category = Input::get('category');
		$commands = Input::get('commands');
		$language = Input::get('language');

		//Retrieve Context from Database

		//Output
		App::abort(404);
	}

	public function GetContextContents()
	{
		//Parameters
		$appId = Input::get('appid');
		$steamId = Input::get('steamid');
		$contextId = Input::get('contextid');

		//Retrieve contents from the Database

		//Output
		App::abort(404);
	}

	public function GetAssetClass()
	{
		//Parameters
		$appId = Input::get('appid');
		$contextId = Input::get('contextid');
		$assetCount = Input::get('asset_count');
		for ($i=0; $i<$assetCount; $i++)
		{
			$assetId = Input::get('asset'.$i);
		}

		//Retrieve assets from the database

		//Output

		App::abort(404);
	}

	public function GetAssetClassInfo()
	{
		//Parameters
		$appId = Input::get('appid');
		$language = Input::get('language');
		$classCount = Input::get('class_count');
		for ($i=0; $i<$classCount; $i++)
		{
			$className = Input::get('class_name'.$i);
			$classValue = Input::get('class_value'.$i);
		}

		//Get the asset info

		//Output

		App::abort(404);
	}

	public function TradeSetUnowned()
	{
		//Parameters
		$appId = Input::get('appid');
		$owner = Input::get('owner');
		$contextId = Input::get('contextid');
		$assetId = Input::get('assetid'); //Make optional
		$currencyId = Input::get('currencyid'); //Make optional
		$amount = Input::get('amount'); //Make optional
		$auditAction = Input::get('audit_action');
		$auditReference = Input::get('audit_reference');
		$leaveOriginal = Input::get('leave_original');
		$requestRepeated = Input::get('request_repeated');

		//check asset ownership matches the specified owner, that the asset or currency is tradable, and that the requested amount is present.

		//Output
		App::abort(404);
	}

	public function TradeSetOwned()
	{
		//Parameters
		$appId = Input::get('appid');
		$owner = Input::get('owner');
		$contextId = Input::get('contextid');
		$assetId = Input::get('assetid'); //Make optional
		$currencyId = Input::get('currencyid'); //Make optional
		$amount = Input::get('amount'); //Make optional
		$auditAction = Input::get('audit_action');
		$auditReference = Input::get('audit_reference');
		$requestRepeated = Input::get('request_repeated');

		// check asset ownership is actually unowned, that the asset or currency is tradable, and that the requested amount is present

		//Output
		App::abort(404);
	}
}