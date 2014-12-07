<?php

class AppTest extends TestCase {

	public function setUp()
	{
		$this->app = Steam::app();
	}

	public function testGetAppDetails()
	{
		$details = $this->app->appDetails(250900); //Binding of Isaac: Rebirth ID

		//Game has all the details
		$this->assertObjectHasAttribute('id', $details->first());
		$this->assertObjectHasAttribute('name', $details->first());
		$this->assertObjectHasAttribute('controllerSupport', $details->first());
		$this->assertObjectHasAttribute('description', $details->first());
		$this->assertObjectHasAttribute('about', $details->first());
		$this->assertObjectHasAttribute('header', $details->first());
		$this->assertObjectHasAttribute('website', $details->first());
		$this->assertObjectHasAttribute('pcRequirements', $details->first());
		$this->assertObjectHasAttribute('legal', $details->first());
		$this->assertObjectHasAttribute('developers', $details->first());
		$this->assertObjectHasAttribute('publishers', $details->first());
		$this->assertObjectHasAttribute('price', $details->first());
		$this->assertObjectHasAttribute('platforms', $details->first());
		$this->assertObjectHasAttribute('metacritic', $details->first());
		$this->assertObjectHasAttribute('categories', $details->first());
		$this->assertObjectHasAttribute('genres', $details->first());
		$this->assertObjectHasAttribute('release', $details->first());
	}

	public function testGetAppList()
	{
		$apps = $this->app->GetAppList();

		//Steam has thousands of apps on it
		$this->assertGreaterThan(10000, count($apps), count($apps));
	}
}