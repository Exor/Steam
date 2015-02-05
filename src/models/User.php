<?php

class SteamApi_User extends \Eloquent
{
	/********************************************************************
	 * Declarations
	 *******************************************************************/
	protected $table = 'steamapi_users';
	protected $primaryKey = 'steamid';
	protected $fillable = array('steamid');

	/********************************************************************
	 * Validation rules
	 *******************************************************************/
	public static $rules = array(
		'steamid'  => 'required'
	);

	/********************************************************************
	 * Relationships
	 *******************************************************************/
    public function orders() { return $this->hasMany('SteamApi_Order', 'steamid', 'steamid'); } //User has many orders
    public function items() { return $this->belongsToMany('SteamApi_Item', 'steamapi_items_users', 'steamid', 'uuid')->withTimestamps(); } //Many to many relationship with the pivot table

	/********************************************************************
	 * Getter and Setter methods
	 *******************************************************************/

	/********************************************************************
	 * Extra Methods
	 *******************************************************************/
}