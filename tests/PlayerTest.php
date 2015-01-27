<?php

class PlayerTest extends TestCase {

	public function setUp()
	{
		parent::setUp();
		$this->player = Steam::player('76561197977832396'); //My profile. Privacy settings are set to public
	}

	public function testGetSteamLevel()
	{
		$level = $this->player->GetSteamLevel();

		//Player level is 17 or higher
		$this->assertGreaterThanOrEqual(17, $level, $level);
	}

	public function testGetPlayerLevelDetails()
	{
		$details = $this->player->GetPlayerLevelDetails();

		//Total experience is greater than 2000xp
		$this->assertGreaterThan(2000, $details->playerXp, $details->playerXp);

		//Player level is 17 or higher
		$this->assertGreaterThanOrEqual(17, $details->playerLevel, $details->playerLevel);

		//Experience to next level is greater than 0
		$this->assertGreaterThan(0, $details->xpToLevelUp, $details->xpToLevelUp);

		//Experience to current level is greater than 2000
		$this->assertGreaterThanOrEqual(2400, $details->xpForCurrentLevel, $details->xpForCurrentLevel);

		//Experience to current level is greater than 2000
		$this->assertGreaterThanOrEqual(2400, $details->xpForCurrentLevel, $details->xpForCurrentLevel);

		//Percent to next level
		$this->assertGreaterThanOrEqual(0, $details->percentToNextLevel, $details->percentToNextLevel);

		//Percent into current level
		$this->assertLessThanOrEqual(99, $details->percentThroughLevel, $details->percentThroughLevel);
	}

	public function testGetBadges()
	{
		$badges = $this->player->GetBadges();

		//Number of badges is greater than 17
		$this->assertGreaterThanOrEqual(17, count($badges), json_encode($badges));
	}

	public function testGetCommunityBadgeProgress()
	{
		$progress = $this->player->GetCommunityBadgeProgress(2); //ID 2 is the community ambassador badge

		//There are more than 5 quests to complete this badge
		$this->assertGreaterThan(5, count($progress), json_encode($progress));
	}

	public function testGetOwnedGames()
	{
		$games = $this->player->GetOwnedGames();

		//Player owns more than 100 games
		$this->assertGreaterThan(100, count($games));

		//First game has an id
		$this->assertGreaterThan(1, $games->first()->appId);

		//Make sure the game has all the defined attributes
		$this->assertObjectHasAttribute('appId', $games->first());
		$this->assertObjectHasAttribute('name', $games->first());
		$this->assertObjectHasAttribute('playtimeTwoWeeks', $games->first());
		$this->assertObjectHasAttribute('playtimeForever', $games->first());
		$this->assertObjectHasAttribute('playtimeForeverReadable', $games->first());
		$this->assertObjectHasAttribute('icon', $games->first());
		$this->assertObjectHasAttribute('logo', $games->first());
		$this->assertObjectHasAttribute('header', $games->first());
		$this->assertObjectHasAttribute('hasCommunityVisibleStats', $games->first());
	}

	public function testGetRecentlyPlayedGames()
	{
		$games = $this->player->GetRecentlyPlayedGames(1); //Get the most recently played game

		//One game in the list
		$this->assertEquals(1, count($games));

		//Game has an id
		$this->assertGreaterThan(1, $games->first()->appId);

		//Game has all the defined attributes
		$this->assertObjectHasAttribute('appId', $games->first());
		$this->assertObjectHasAttribute('name', $games->first());
		$this->assertObjectHasAttribute('playtimeTwoWeeks', $games->first());
		$this->assertObjectHasAttribute('playtimeForever', $games->first());
		$this->assertObjectHasAttribute('playtimeForeverReadable', $games->first());
		$this->assertObjectHasAttribute('icon', $games->first());
		$this->assertObjectHasAttribute('logo', $games->first());
		$this->assertObjectHasAttribute('header', $games->first());
		$this->assertObjectHasAttribute('hasCommunityVisibleStats', $games->first());
	}

	public function testIsPlayingSharedGame()
	{
		$sharerSteamId = $this->player->IsPlayingSharedGame(250900); //Binding of Isaac: Rebirth ID

		//Will be equal to zero unless player is playing the shared game
		$this->assertEquals(0, $sharerSteamId, $sharerSteamId);
	}
}