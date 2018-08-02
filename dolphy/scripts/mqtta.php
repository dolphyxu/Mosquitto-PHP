<?php
/**
 * Created by PhpStorm.
 * User: dol
 * Date: 18-8-1
 * Time: 下午5:31
 */

use App\Controllers\PubClient;
use App\Controllers\SubClient;

$operation = $argv[1];
$topic = $argv[2];
$message = "";

if ($operation == 'sub') {
    sub($topic);
} else if ($operation == 'pub') {
    for ($i=3; $i<$argc; $i++) {
        $message .= $argv[$i];
        $message .= " ";
    }
    pub($topic, $message);
}


function sub($topic) {
    $client = new SubClient($topic, "");
    $client->onConnect('connect');
    $client->onDisconnect('disconnect');
    $client->onSubscribe('subscribe');
    $client->onMessage('message');
    $client->connect("localhost", 1883, 5);
    $client->subscribe($topic, 1);
    while (true) {
        $client->loop();
    }
}

function pub($topic, $message) {
    $client = new PubClient($topic, $message);
    $client->onConnect('connect');
    $client->onDisconnect('disconnect');
    $client->connect("localhost", 1883, 5);
    $client->publish($topic, $message . date('Y-m-d H:i:s'), 1, 0);
}


