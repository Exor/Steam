<?php namespace AbyssalArts\SteamApi\Controllers;

class AssetsController extends \Controller {

	public function GetAssetManifest()
	{
		$unlockedItems = \SteamApi_Item::all();
		$manifest = array('response' => 'OK', 'items' => $unlockedItems->toArray());
		return json_encode($manifest);
	}

	public function GetUnlockedItems()
	{
		$steamid = \Input::get('steamid');
		$unlocks = \SteamApi_Unlock::where('steamid', $steamid)->get();
		
		$uuids = [];
		foreach ($unlocks as $unlock)
		{
			$uuids[] = $unlock->uuid;
		}
		$statement = ['response' => 'OK', 'unlocks' => $uuids];
		return json_encode($statement);
	}
}