<?php

class UserStatsTest extends TestCase {

	public function setUp()
	{
		parent::setUp();
		$this->stats = Steam::userStats('76561197977832396'); //My profile. Privacy settings are set to public
	}

	public function testGetPlayerAchievements()
	{
		$achievements = $this->stats->GetPlayerAchievements(250900); //Binding of Isaac: Rebirth ID

		//Game has more than 100 achievements
		$this->assertGreaterThanOrEqual(100, count($achievements), json_encode($achievements));

		//Achievement has all the attributes
		$this->assertObjectHasAttribute('apiName', $achievements->first());
		$this->assertObjectHasAttribute('achieved', $achievements->first());
		$this->assertObjectHasAttribute('name', $achievements->first());
		$this->assertObjectHasAttribute('description', $achievements->first());
	}

	public function testGetGlobalAchievementPercentagesForApp()
	{
		$achievements = $this->stats->GetGlobalAchievementPercentagesForApp(250900); //Binding of Isaac: Rebirth ID

		//Game has more than 100 achievements
		$this->assertGreaterThanOrEqual(100, count($achievements), json_encode($achievements));

		//Achievement has all the attributes
		$this->assertObjectHasAttribute('name', $achievements[1]);
		$this->assertObjectHasAttribute('percent', $achievements[1]);
	}

	public function testGetUserStatsForGame()
	{
		$achievements = $this->stats->GetUserStatsForGame(250900); //Binding of Isaac: Rebirth ID

		//Player has completed more than 50 achievements
		$this->assertGreaterThanOrEqual(50, count($achievements), json_encode($achievements));

		//Achievement has all the attributes
		$this->assertObjectHasAttribute('achieved', $achievements[1]);
		$this->assertObjectHasAttribute('name', $achievements[1]);
	}
}