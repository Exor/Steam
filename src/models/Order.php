<?php

class SteamApi_Order extends \Eloquent
{
	/********************************************************************
	 * Declarations
	 *******************************************************************/
	protected $table = 'steamapi_orders';
	protected $primaryKey = 'orderid';

	/********************************************************************
	 * Aware validation rules
	 *******************************************************************/
	/**
	 * Validation rules
	 *
	 * @static
	 * @var array $rules All rules this model must follow
	 */
	public static $rules = array(
		'orderid' => 'unique:steamapi_orders',
		'transid' => 'unique:steamapi_orders',
		'steamid' => 'required'
	);

	/********************************************************************
	 * Relationships
	 *******************************************************************/
	public function user() { return $this->belongsTo('SteamApi_User', 'steamid', 'steamid'); } //Order has one User
	public function items() { return $this->belongsToMany('SteamApi_Item', 'steamapi_items_orders', 'orderid', 'uuid')->withTimestamps(); } //Many to many relationship with the pivot table

	/********************************************************************
	 * Getter and Setter methods
	 *******************************************************************/

	/********************************************************************
	 * Extra Methods
	 *******************************************************************/
}