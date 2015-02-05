<?php

class SteamApi_Item extends \Eloquent
{
	/********************************************************************
	 * Declarations
	 *******************************************************************/
	protected $table = 'steamapi_items';
	protected $primaryKey = 'uuid';

	/********************************************************************
	 * Aware validation rules
	 *******************************************************************/
	public static $rules = array(
		'uuid' => 'required',
		'name'  => 'required',
		'description'  => 'required',
		'price'  => 'required',
		'version'  => 'required'
	);

	/********************************************************************
	 * Relationships
	 *******************************************************************/
	public function orders() { return $this->belongsToMany('SteamApi_Order', 'steamapi_items_orders', 'uuid', 'orderid')->withTimestamps(); } //Many to many relationship with the pivot table
	public function users() { return $this->belongsToMany('SteamApi_User', 'steamapi_items_users', 'uuid', 'steamid')->withTimestamps(); } //Many to many relationship with the pivot table
	/********************************************************************
	 * Getter and Setter methods
	 *******************************************************************/

	/********************************************************************
	 * Extra Methods
	 *******************************************************************/
}