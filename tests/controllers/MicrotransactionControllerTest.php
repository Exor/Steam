<?php

class MicrotransactionControllerTest extends TestCase {

public function testCanStartAndFinishMicrotransactionWithValidParameters()
{
    //
    $response = $this->call('POST', 'initTxn', array(
        'order' => '{"orderid":0,"transid":0,"errorcode":0,"errordescription":null,"language":"EN","currency":"USD","steamid":76561197977832396,"items":[{"itemid":123456,"qty":1,"amount":199,"description":"Red Hat","category":"hats"}]}'
        )   
    );

    $this->assertTrue($this->client->getResponse()->isOk());
    $content = $this->client->getResponse()->getContent();
    $content = json_decode($content);
    $this->assertEquals('OK', $content->response, json_encode($content));

    //Get the order from the database
    $order = \SteamApi_Order::where('steamid', '76561197977832396')->first();

    //Check the order
    $this->assertFalse(is_null($order));
    $this->assertEquals($content->transid, $order->transid);
    $this->assertEquals($content->orderid, $order->orderid);

    //Finalize the order
    $response = $this->call('POST', 'finalizeTxn', array(
        'orderid' => $order->orderid
        )
    );

    $this->assertTrue($this->client->getResponse()->isOk());
    $content = $this->client->getResponse()->getContent();
    $content = json_decode($content);

    //Finalize will always fail since it requires user interaction to approve the transaction
    $this->assertEquals('Failure', $content->response, json_encode($content));
    $this->assertEquals('5', $content->errorcode);
    $this->assertEquals('User has not approved transaction', $content->errordesc);
}

}