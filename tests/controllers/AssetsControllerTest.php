<?php

class AssetsControllerTest extends TestCase {

public function setUp()
{
    parent::setUp();
    $this->item = new SteamApi_Item();
    $this->item->uuid = "01234567890123456789";
    $this->item->name = "Red Hat";
    $this->item->description = "A silly red hat.";
    $this->item->price = 199;
    $this->item->version = 1.004;
    $this->assertTrue($this->item->save());

    $this->unlock = new SteamApi_Unlock();
    $this->unlock->steamid = "123456";
    $this->unlock->uuid = "01234567890123456789";
    $this->assertTrue($this->unlock->save());    

    $this->unlock2 = new SteamApi_Unlock();
    $this->unlock2->steamid = "123456";
    $this->unlock2->uuid = "9876543210";
    $this->assertTrue($this->unlock2->save());  
}

public function tearDown()
{
    $items = SteamApi_Item::all();
    foreach($items as $item) {$item->delete();}
}

public function testCanGetAssetManifest()
{
    $response = $this->call('GET', 'getAssetManifest');

    $this->assertTrue($this->client->getResponse()->isOk());
    $manifest = $this->client->getResponse()->getContent();
    $manifest = json_decode($manifest);
    $this->assertEquals('OK', $manifest->response);
    $this->assertEquals($this->item->uuid, $manifest->items[0]->uuid);
}

public function testCanGetUnlockedItems()
{
    $response = $this->call('POST', 'getUnlockedItems',array('steamid' => '123456'));

    $this->assertTrue($this->client->getResponse()->isOk());
    $unlocks_table = $this->client->getResponse()->getContent();
    $unlocks_table = json_decode($unlocks_table);
    $this->assertEquals('OK', $unlocks_table->response);
    $this->assertEquals($this->unlock->uuid, $unlocks_table->unlocks[0]);
}
}