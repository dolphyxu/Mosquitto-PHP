<?php
/**
 * Created by PhpStorm.
 * User: dol
 * Date: 18-8-1
 * Time: 下午5:31
 */

//$param_arr = getopt('a:b:c:');
//$operation = $param_arr["a"];
//$topic = $param_arr["b"];
//$message = $param_arr["c"];  //没办法得到带空格的字符串参数


$client = new Mosquitto\Client();
$client->onConnect('connect');
$client->onDisconnect('disconnect');
$client->onSubscribe('subscribe');
$client->onMessage('message');


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
    global $client;
    $client->connect("localhost", 1883, 5);
    $client->subscribe($topic, 1);
    while (true) {
        $client->loop();
    }
}

function pub($topic, $message) {
    global $client;
    $client->connect("localhost", 1883, 5);
    $client->publish($topic, $message . date('Y-m-d H:i:s'), 1, 0);
}


$client->disconnect();
unset($client);


function connect($r) {
    echo "I got code {$r}\n";
//    global $client;
//    global $topic;
//    $client->subscribe($topic, 1);
}

function subscribe() {
    echo "Subscribed to a topic\n";
}

function message($message) {
    printf("Got a message on topic %s with payload: %s\n", $message->topic, $message->payload);
}

function disconnect() {
    echo "Disconnected cleanly\n";
}

