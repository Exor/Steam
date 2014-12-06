<?php

class MicrotransactionTest extends TestCase {

	public function testGetNewsForApp()
	{
		$appId = 440; //Team Fortress 2
		$news = Steam::news()->GetNewsForApp($appId, 5, 500)->newsitems;

		//Page loads properly
		$this->assertEquals(5, $news->count());
	}
}