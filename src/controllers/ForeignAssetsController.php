<?php namespace AbyssalArts\SteamApi\Controllers;

class ForeignAssetsController extends \Controller {

	public function GetExportedAssets()
	{
		//Parameters
		//Parameters
		$appId = Input::get('appid');
		$steamId = Input::get('steamid');
		$contextId = Input::get('contextid');

		//Output
		App::abort(404);
	}
}