<?php

//Steam Trading Routes
Route::get('assetapi/GetContexts/v0001', 'AbyssalArts\SteamApi\Controllers\SteamTradingController@GetContexts');
Route::get('assetapi/GetContextContents/v0001', 'AbyssalArts\SteamApi\Controllers\SteamTradingController@GetContextContents');
Route::get('assetapi/GetAssetClass/v0001', 'AbyssalArts\SteamApi\Controllers\SteamTradingController@GetAssetClass');
Route::get('assetapi/GetAssetClassInfo/v0001', 'AbyssalArts\SteamApi\Controllers\SteamTradingController@GetAssetClassInfo');
Route::post('assetapi/TradeSetUnowned/v0001', 'AbyssalArts\SteamApi\Controllers\SteamTradingController@TradeSetUnowned');
Route::post('assetapi/TradeSetOwned/v0001', 'AbyssalArts\SteamApi\Controllers\SteamTradingController@TradeSetOwned');

//Steam Support Tool Integration Routes
Route::post('assetapi/ContextCommand/v0001', 'AbyssalArts\SteamApi\Controllers\SteamSupportToolController@ContextCommand');
Route::get('assetapi/GetUserHistory/v0001', 'AbyssalArts\SteamApi\Controllers\SteamSupportToolController@GetUserHistory');
Route::get('assetapi/GetHistoryCommandDetails/v0001', 'AbyssalArts\SteamApi\Controllers\SteamSupportToolController@GetHistoryCommandDetails');
Route::post('assetapi/HistoryExecuteCommands/v0001', 'AbyssalArts\SteamApi\Controllers\SteamSupportToolController@HistoryExecuteCommands');
Route::get('assetapi/SupportGetAssetHistory/v0001', 'AbyssalArts\SteamApi\Controllers\SteamSupportToolController@SupportGetAssetHistory');

//Web Purchasing
Route::post('assetapi/StartWebAssetTransaction/v0001', 'AbyssalArts\SteamApi\Controllers\WebPurchasingController@StartWebAssetTransaction');
Route::post('assetapi/FinalizeWebAssetTransaction/v0001', 'AbyssalArts\SteamApi\Controllers\WebPurchasingController@FinalizeWebAssetTransaction');
Route::get('assetapi/GetAssetPrices/v0001', 'AbyssalArts\SteamApi\Controllers\WebPurchasingController@GetAssetPrices');

//Foreign Assets
Route::get('assetapi/GetExportedAssets/v0001', 'AbyssalArts\SteamApi\Controllers\ForeignAssetsController@GetExportedAssets');

//Microtransactions
Route::post('initTxn', 'AbyssalArts\SteamApi\Controllers\MicrotransactionController@StartMicrotransaction');
Route::post('finalizeTxn', 'AbyssalArts\SteamApi\Controllers\MicrotransactionController@FinishMicrotransaction');

//Disabled because we don't want just anyone refunding their transactions or requesting a financial report
//Route::post('refundTxn', 'AbyssalArts\SteamApi\Controllers\MicrotransactionController@RefundMicrotransaction');
//Route::post('getReport', 'AbyssalArts\SteamApi\Controllers\MicrotransactionController@GetMicrotransactionReport');

//Asset Manifest
Route::get('getAssetManifest', 'AbyssalArts\SteamApi\Controllers\AssetsController@GetAssetManifest');
Route::post('uploadAssetManifest', 'AbyssalArts\SteamApi\Controllers\AssetsController@UploadAssetManifest');

//Unlock Table
Route::post('getUnlockedItems', 'AbyssalArts\SteamApi\Controllers\AssetsController@GetUnlockedItems');