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
		//Since this will likely be the first entrypoint for many users check to see if there is an existing entry, otherwise create one.
		$user = \SteamApi_User::firstOrCreate(array('steamid' => $steamid));
		$unlockedItems = $user->items;
		
		$uuids = [];
		foreach ($unlockedItems as $item)
		{
			$uuids[] = $item->uuid;
		}
		$unlockTable = ['response' => 'OK', 'unlocks' => $uuids, 'xp' => $user->xp];
		return json_encode($unlockTable);
	}

	public function UploadAssetManifest()
	{
		$manifest = \Input::get('manifest');
		$manifest = json_decode($manifest);

		foreach ($manifest->Items as $manifestItem)
		{
			$item = \SteamApi_Item::firstOrNew(array('uuid' => $manifestItem->uuid));
			$item->uuid = $manifestItem->uuid;
			$item->name = $manifestItem->name;
			$item->description = $manifestItem->description;
			$item->price = $manifestItem->price;
			$item->version = $manifestItem->version;
			$item->save();
		}


		return json_encode(['response' => 'OK']);
	}
}