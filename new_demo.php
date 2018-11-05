<?php

date_default_timezone_set('Asia/Shanghai');


$arr = array(1,2,3,4,6,7,8);


function getContinuous($arr, $direct = 'up2down')
{
    if ($direct == 'up2down') {
        for ($i = 0; $i < count($arr) - 1; $i++) {
            if ($arr[$i + 1] - 1 != $arr[$i])
                return $i;
        }
    } else {
        for ($i = count($arr) - 1; $i > 0; $i--) {
            if ($arr[$i] - 1 != $arr[$i - 1])
                return $i;
        }
    }

    return -1;
}

var_dump(getContinuous($arr, 'up2down'));
var_dump(getContinuous($arr, 'down2up'));
exit;
$tn = time();
$te = $tn - 36002;

$dtn = new DateTime();
$dte = new DateTime();

$dtn->setTimestamp($tn);
echo $dtn->format('U = Y-m-d H:i:s') . "\n";
$dte->setTimestamp($te);
echo $dte->format('U = Y-m-d H:i:s') . "\n";

echo (string)$dte->diff($dtn)->s;

exit;
try {
    try {
        throw new RuntimeException('ss');
    } catch (OutOfRangeException $e) {
        echo "yyy";
        echo $e->getMessage();
    }
} catch (RuntimeException $e) {
    echo "xxxx";
    echo $e->getMessage();
}

exit;
$path   = __DIR__ . '/test.zep';
$retval = zephir_parse_file(file_get_contents($path), $path);

echo PHP_EOL;
var_export($retval);
echo PHP_EOL;

exit;
use Phalcon\Mvc\Url;

$url = new Url();

var_dump($url->get('products/save'));

exit;
// Required
$config = [
    'host'     => '127.0.0.1',
    'username' => 'root',
    'password' => '',
    'dbname'   => 'phosphorum',
];

// Optional
$config['persistent'] = false;

// Create a connection
$connection = new \Phalcon\Db\Adapter\Pdo\Mysql($config);

var_dump($connection);





exit;
$value['info']['dd'] = 'a';
$value['info']['password_maxage_flag'] = 'b';
$value['info']['password_minage_flag'] = 'c';
$filter_info_field = array("password_maxage_flag", "password_minage_flag", "password_minlength_flag", "password_remember_history_flag");
var_dump($value);

foreach($value as &$array){
    foreach($array as $key => &$value1){
        if(in_array($key, $filter_info_field)) {
            echo "what ?";
            unset($array[$key]);
        }
    }
}
//foreach ($value['info'] as $key => $value) {
//    if (in_array($key, $filter_info_field)) {
//        unset($value['info'][$key]);
//    }
//}

var_dump($value);