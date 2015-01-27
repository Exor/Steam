<?php

class UserTest extends TestCase {

	public function setUp()
	{
		parent::setUp();
		$this->user = Steam::user('76561197977832396'); //My profile. Privacy settings are set to public
	}

	public function testGetPlayerSummaries()
	{
		$summaries = $this->user->GetPlayerSummaries();

		//Player summary has all the attributes
		$this->assertObjectHasAttribute('steamId', $summaries->first());
		$this->assertObjectHasAttribute('communityVisibilityState', $summaries->first());
		$this->assertObjectHasAttribute('profileState', $summaries->first());
		$this->assertObjectHasAttribute('personaName', $summaries->first());
		$this->assertObjectHasAttribute('lastLogoff', $summaries->first());
		$this->assertObjectHasAttribute('profileUrl', $summaries->first());
		$this->assertObjectHasAttribute('avatar', $summaries->first());
		$this->assertObjectHasAttribute('avatarMedium', $summaries->first());
		$this->assertObjectHasAttribute('avatarFull', $summaries->first());
		$this->assertObjectHasAttribute('avatarUrl', $summaries->first());
		$this->assertObjectHasAttribute('avatarMediumUrl', $summaries->first());
		$this->assertObjectHasAttribute('avatarFullUrl', $summaries->first());
		$this->assertObjectHasAttribute('personaState', $summaries->first());
		$this->assertObjectHasAttribute('personaStateId', $summaries->first());
		$this->assertObjectHasAttribute('realName', $summaries->first());
		$this->assertObjectHasAttribute('primaryClanId', $summaries->first());
		$this->assertObjectHasAttribute('timecreated', $summaries->first());
		$this->assertObjectHasAttribute('personaStateFlags', $summaries->first());
		$this->assertObjectHasAttribute('locCountryCode', $summaries->first());
		$this->assertObjectHasAttribute('locStateCode', $summaries->first());
		$this->assertObjectHasAttribute('locCityId', $summaries->first());
	}

	public function testGetFriendList()
	{
		$friends = $this->user->GetFriendList();

		//Player has more than one friend
		$this->assertGreaterThan(0, count($friends), json_encode($friends));

		//Friend has all the attributes
		$this->assertObjectHasAttribute('steamId', $friends->first());
		$this->assertObjectHasAttribute('communityVisibilityState', $friends->first());
		$this->assertObjectHasAttribute('profileState', $friends->first());
		$this->assertObjectHasAttribute('personaName', $friends->first());
		$this->assertObjectHasAttribute('lastLogoff', $friends->first());
		$this->assertObjectHasAttribute('profileUrl', $friends->first());
		$this->assertObjectHasAttribute('avatar', $friends->first());
		$this->assertObjectHasAttribute('avatarMedium', $friends->first());
		$this->assertObjectHasAttribute('avatarFull', $friends->first());
		$this->assertObjectHasAttribute('avatarUrl', $friends->first());
		$this->assertObjectHasAttribute('avatarMediumUrl', $friends->first());
		$this->assertObjectHasAttribute('avatarFullUrl', $friends->first());
		$this->assertObjectHasAttribute('personaState', $friends->first());
		$this->assertObjectHasAttribute('personaStateId', $friends->first());
		$this->assertObjectHasAttribute('realName', $friends->first());
		$this->assertObjectHasAttribute('primaryClanId', $friends->first());
		$this->assertObjectHasAttribute('timecreated', $friends->first());
		$this->assertObjectHasAttribute('personaStateFlags', $friends->first());
		$this->assertObjectHasAttribute('locCountryCode', $friends->first());
		$this->assertObjectHasAttribute('locStateCode', $friends->first());
		$this->assertObjectHasAttribute('locCityId', $friends->first());
	}
}