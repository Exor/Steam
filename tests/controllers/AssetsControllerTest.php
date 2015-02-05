<?php

class AssetsControllerTest extends TestCase {

public function setUp()
{
    parent::setUp();

    //Create an Item
    $this->item = new SteamApi_Item();
    $this->item->uuid = "01234567890123456789";
    $this->item->name = "Red Hat";
    $this->item->description = "A silly red hat.";
    $this->item->price = 199;
    $this->item->version = 1.004;
    $this->assertTrue($this->item->save());

    //Create a User
    $this->user = new SteamApi_User();
    $this->user->steamid = '1234567890';
    $this->assertTrue($this->user->save());

    //Give the item to the User
    $this->user->items()->attach($this->item->uuid);
}

public function tearDown()
{
    $users = SteamApi_User::all();
    foreach($users as $user) {$user->delete();}
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
    $response = $this->call('POST', 'getUnlockedItems',array('steamid' => $this->user->steamid));

    $this->assertTrue($this->client->getResponse()->isOk());
    $unlocks_table = $this->client->getResponse()->getContent();
    $unlocks_table = json_decode($unlocks_table);
    $this->assertEquals('OK', $unlocks_table->response);
    $this->assertEquals($this->item->uuid, $unlocks_table->unlocks[0]);
}
}