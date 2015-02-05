<?php

class SteamApi_Order extends \Eloquent
{
	/********************************************************************
	 * Declarations
	 *******************************************************************/
	protected $table = 'steamapi_orders';

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
	public function user() { return $this->belongsTo('SteamApi_User', 'steamid'); } //Order has one User

	/********************************************************************
	 * Getter and Setter methods
	 *******************************************************************/

	/********************************************************************
	 * Extra Methods
	 *******************************************************************/
}