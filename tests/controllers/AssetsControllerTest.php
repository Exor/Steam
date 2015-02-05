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
    $this->assertEquals('OK', $manifest->response, json_encode($manifest));
    $this->assertEquals($this->item->uuid, $manifest->items[0]->uuid, json_encode($manifest));
}

}