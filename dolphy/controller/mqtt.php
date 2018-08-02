<?php
/**
 * Created by PhpStorm.
 * User: dol
 * Date: 18-8-1
 * Time: 下午5:31
 */

include "SubClient.php";
include "PubClient.php";


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
    $client->sub();
}

function pub($topic, $message) {
    $client = new PubClient($topic, $message);
    $client->pub();
}


