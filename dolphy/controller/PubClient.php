<?php
/**
 * Created by PhpStorm.
 * User: dol
 * Date: 18-8-2
 * Time: 上午11:01
 */

//include 'MQTTClient.php';

class PubClient extends MQTTClient
{
    public function pub() {
        $this->client->publish($this->topic, $this->message . date('Y-m-d H:i:s'), 1, 0);

        $this->client->disconnect();
        unset($this->client);
    }
}