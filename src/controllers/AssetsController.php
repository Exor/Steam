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
		$unlockedItems = \SteamApi_User::find($steamid)->items;
		
		$uuids = [];
		foreach ($unlockedItems as $item)
		{
			$uuids[] = $item->uuid;
		}
		$unlockTable = ['response' => 'OK', 'unlocks' => $uuids];
		return json_encode($unlockTable);
	}
}