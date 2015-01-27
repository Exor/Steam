<?php

class MicrotransactionControllerTest extends TestCase {

public function testCanStartAndFinishMicrotransactionWithValidParameters()
{
    $response = $this->call('POST', 'initTxn', array(
        'steamid' => '76561197977832396',
        'items' => '[{"itemid":"123456", "qty":"1", "amount":"199", "description":"Red Hat", "category":"hats"}]',
        'language' => 'EN',
        'currency' => 'USD'
        )   
    );

    $this->assertTrue($this->client->getResponse()->isOk());
    $content = $this->client->getResponse()->getContent();
    $content = json_decode($content);
    $this->assertEquals('OK', $content->result);

    //Get the order from the database
    $order = \SteamApi_Order_Test::where('steamid', '76561197977832396')->first();

    //Check the order
    $this->assertFalse(is_null($order));
    $this->assertEquals($content->params->transid, $order->transid);
    $this->assertEquals($content->params->orderid, $order->orderid);

    //Finalize the order
    $response = $this->call('POST', 'finalizeTxn', array(
        'orderid' => $order->orderid
        )
    );

    $this->assertTrue($this->client->getResponse()->isOk());
    $content = $this->client->getResponse()->getContent();
    $content = json_decode($content);

    //Finalize will always fail since it requires user interaction to approve the transaction
    $this->assertEquals('Failure', $content->result, json_encode($content));
    $this->assertEquals('5', $content->error->errorcode);
    $this->assertEquals($content->params->transid, $order->transid);
    $this->assertEquals($content->params->orderid, $order->orderid);
}

}