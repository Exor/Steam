<?php namespace AbyssalArts\SteamApi\Controllers;

class WebPurchasingController extends \Controller {

	public function StartWebAssetTransaction()
	{
		//Parameters
		$appId = Input::get('appid');
		$language = Input::get('language');
		$asset[] = Input::get('asset'); //TODO Check this
		$quantity[] = Input::get('quantity'); //TODO Check this
		$currency = Input::get('currency');
		$ipAddress = Input::get('ipaddress');
		$referrer = Input::get('referrer');
		
		//Call ISteamMicroTxn/InitTxn

		//Output

		App::abort(404);
	}

	public function FinalizeWebAssetTransaction()
	{
		//Parameters
		$appId = Input::get('appid');
		$steamId = Input::get('steamid');
		$language = Input::get('language');
		$transactionId = Input::get('txnid');

		//Call ISteamMicroTxn/FinalizeTxn

		//Output
		
		App::abort(404);
	}

	public function GetAssetPrices()
	{
		//Parameters
		$appId = Input::get('appid');
		$language = Input::get('language');
		$currency = Input::get('currency');
		$classCount = Input::get('class_count');
		for ($i=0; $i<$classCount; $i++)
		{
			$className = Input::get('class_name'.$i);
			$classValue = Input::get('class_value'.$i);
		}
		
		//Get asset data from the database

		//Output

		App::abort(404);
	}
}