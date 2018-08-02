<?php
/**
 * Created by PhpStorm.
 * User: dol
 * Date: 18-8-2
 * Time: 上午10:57
 */

include 'MQTTClient.php';

class SubClient extends MQTTClient
{
    public function sub() {
//        $this->client->onConnect('connect');
//        $this->client->onDisconnect('disconnect');
//        $this->client->onSubscribe('subscribe');
//        $this->client->onMessage('message');

        $this->client->subscribe($this->topic, 1);
        while (true) {
            $this->client->loop();
        }


        $this->client->disconnect();
        unset($this->client);
    }
}