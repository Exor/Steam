<?php

class SteamApi_Item extends \Eloquent
{
	/********************************************************************
	 * Declarations
	 *******************************************************************/
	protected $table = 'steamapi_items';

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

	/********************************************************************
	 * Getter and Setter methods
	 *******************************************************************/

	/********************************************************************
	 * Extra Methods
	 *******************************************************************/
}