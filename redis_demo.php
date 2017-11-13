<?php
include "vendor/autoload.php";
$redis = new \Predis\Client();

try {
    $abc = $redis->hmget("zssdd", array());
    //echo $abc;
} catch (Exception $e) {
    echo $e->getMessage();
}
