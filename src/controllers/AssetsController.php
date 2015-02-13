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
		//Get all the Inputs
		$manifest = \Input::get('manifest');
		$key = \Input::get('key');
		if ($key != $this->ComputeHashKey($manifest))
			{ return json_encode(['response' => 'Failure', 'errorcode' => '501', 'errordesc' => 'Invalid key']); }



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

	public function UploadAccountXp()
	{
		//Get all the Inputs
		$steamid = \Input::get('steamid');
		$xp = \Input::get('accountXP');
		$key = \Input::get('key');
		if ($key != $this->ComputeHashKey($steamid . $xp))
			{ return json_encode(['response' => 'Failure', 'errorcode' => '501', 'errordesc' => 'Invalid key']); }

		$user = \SteamApi_User::find($steamid);
		$user->xp = $xp;

		if ($user->save())
			{ return json_encode(['response' => 'OK']); }
		else
			{ return json_encode(['response' => 'Failure', 'errorcode' => '502', 'errordesc' => 'Steam ID not found']); }

	}

	private function ComputeHashKey($string)
	{
		return hash(\Config::get('steam-api::hashingAlgorithm'), \Config::get('steam-api::secretKey') . $string);
	}
}