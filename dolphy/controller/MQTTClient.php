<?php
/**
 * Created by PhpStorm.
 * User: dol
 * Date: 18-8-2
 * Time: 上午10:57
 */


class MQTTClient
{
    protected $client,$topic,$message;
    public function __construct($topic,$message)
    {
        $this->client = new Mosquitto\Client;
        $this->topic = $topic;
        $this->message = $message;

        $this->init();

        $this->client->connect("localhost", 1883, 5);
    }

    public function init(){
        $this->client->onConnect(function () {
            echo "connected\n";
        });
        $this->client->onDisconnect(function (){
            echo "Disconnected cleanly\n";
        });
        $this->client->onSubscribe(function () {
            printf("Subscribed to a topic: %s\n", $this->topic);
        });
        $this->client->onMessage(function ($message) {
            printf("Got a message on topic %s with payload:\n%s\n", $message->topic, $message->payload);
            $sub_file = fopen("msg.txt", "a");
            $msg = "Got a message on topic ".$message->topic." with payload: ".$message->payload."\n";
            fwrite($sub_file, $msg);
            fclose($sub_file);
        });
    }
}