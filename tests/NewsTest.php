<?php

class NewsTest extends TestCase {

	public function testGetNewsForApp()
	{
		$appId = 440; //Team Fortress 2
		$news = Steam::news()->GetNewsForApp($appId, 5, 500)->newsitems;

		//Retrieved 5 news items
		$this->assertEquals(5, count($news), json_encode($news));
	}
}