<?php
/**
 * Created by PhpStorm.
 * User: dol
 * Date: 18-8-1
 * Time: 下午5:15
 */

$core_path = 'mqtt.php';


//$param_arr = getopt('a:b:c:');
//$operation = $param_arr["a"];
//$topic = $param_arr["b"];
//$message = $param_arr["c"]; //没办法得到带空格的字符串参数


$operation = $argv[1];
$topic = $argv[2];
$message = "";
if ($operation=='pub' && $argc>3) {
    $message = $argv[3];
}


if ($operation == 'sub') {
    $cmd = "php " . $core_path . " sub " . $topic;
} else if ($operation == 'pub') {
    $cmd = "php " . $core_path . " pub " . $topic . " " . $message;
}

exec($cmd, $result, $ret);
