<?php
//date_default_timezone_set('Asia/Shanghai');
error_reporting(-1);

$bind_vals = [
    ':name' => 'test',
    ':detail' => 'this is detail'
];
var_dump(implode(',', array_keys($bind_vals)));
exit;

ob_start();
include "example.php";

$out = ob_get_clean();
$out = strtolower($out);

var_dump($out);

exit;
//Enter your code here, enjoy!

$arr3 = [];

$arr1 = [
    ['date' => '2017-06-9', 'customer_id' => 1161, 'total' => 3, 'cg' => 1],
    ['date' => '2017-06-11', 'customer_id' => 1163, 'total' => 8, 'cg' => 3],
    ['date' => '2017-06-11', 'customer_id' => 1165, 'total' => 10, 'cg' => 5],
    ['date' => '2017-06-12', 'customer_id' => 1163, 'total' => 4, 'cg' => 2],

];
$arr2 = [
    ['date' => '2017-06-10', 'customer_id' => 1161, 'total' => 3, 'cg' => 1],
    ['date' => '2017-06-11', 'customer_id' => 1165, 'total' => 9, 'cg' => 2],
    ['date' => '2017-06-13', 'customer_id' => 1165, 'total' => 6, 'cg' => 5]
];

$flag = 0;
foreach ($arr1 as $key1 => $item1) {
    $date1 = $item1['date'];
    $customer_id1 = $item1['customer_id'];
    $total1 = $item1['total'];
    $cg1 = $item1['cg'];
    foreach ($arr2 as $key2 => $item2) {
        $date2 = $item2['date'];
        $customer_id2 = $item2['customer_id'];
        $total2 = $item2['total'];
        $cg2 = $item2['cg'];

        if ($date1 == $date2 && $customer_id1 == $customer_id2) {
            echo $date1 . '|' . $customer_id1;
            $total = $total1 + $total2;
            $cg = $cg1 + $cg2;
            $arr2[$key2]['total'] = $total;
            $arr2[$key2]['cg'] = $cg;
            $flag = 1;
            //array_push($arr2, ['date' => $date1, 'customer_id' => $customer_id1, 'total' => $total, 'cg' => $cg]);
            break;
        }
    }

    if ($flag == 0) {
        array_push($arr2, $item1);
    }

}
print_r($arr1);
print_r($arr2);
exit;
var_dump(base64_encode('299999999-11111111111'));
var_dump(base64_decode('Mjk5OTk5OTk5LTM5OTk5OTk5OS01OTk5OTk5OTktNTk5OTk5OTk5'));

function compress($input, $ascii_offset = 38){
    $input = strtoupper($input);
    $output = '';
    //We can try for a 4:3 (8:6) compression (roughly), 24 bits for 4 chars
    foreach(str_split($input, 4) as $chunk) {
        $chunk = str_pad($chunk, 4, '=');

        $int_24 = 0;
        for($i=0; $i<4; $i++){
            //Shift the output to the left 6 bits
            $int_24 <<= 6;

            //Add the next 6 bits
            //Discard the leading ascii chars, i.e make
            $int_24 |= (ord($chunk[$i]) - $ascii_offset) & 0b111111;
        }

        //Here we take the 4 sets of 6 apart in 3 sets of 8
        for($i=0; $i<3; $i++) {
            $output = pack('C', $int_24) . $output;
            $int_24 >>= 8;
        }
    }

    return $output;
}

function decompress($input, $ascii_offset = 38) {

    $output = '';
    foreach(str_split($input, 3) as $chunk) {

        //Reassemble the 24 bit ints from 3 bytes
        $int_24 = 0;
        foreach(unpack('C*', $chunk) as $char) {
            $int_24 <<= 8;
            $int_24 |= $char & 0b11111111;
        }

        //Expand the 24 bits to 4 sets of 6, and take their character values
        for($i = 0; $i < 4; $i++) {
            $output = chr($ascii_offset + ($int_24 & 0b111111)) . $output;
            $int_24 >>= 6;
        }
    }

    //Make lowercase again and trim off the padding.
    return strtolower(rtrim($output, '='));
}

var_dump(compress('299999999-11111111111'));
var_dump(decompress(compress('299999999-1111111111')));
exit;


$a = null;

foreach ($a as $b) {
    echo $a;
}

exit;

//function  (&$var)
//{
//    $var++;
//}
//
//function &bar()
//{
//    $a = 5;
//    return $a;
//}
//
//$x = foo(bar());
//var_dump($x);
//
//exit;
//$a = array ('zero','one','two', 'three');
//
//foreach ($a as &$v) {
//
//}
//
//foreach ($a as $v) {
//    echo $v.PHP_EOL;
//}
//exit;

$a = array(1,3 ,5);
//$v = $a[2];
//var_dump($v);



foreach($a as &$value) {}



//var_dump($a);
foreach($a as $value) {
    var_dump($a);
}

//var_dump($a);

exit;

final class Base
{
    public static function test() {
        echo "hello world!";
    }
}

Base::test();


exit;

$RequestData=urldecode('                            {
                                \\"AcceptStation\\":\\"\\u6df1\\u5733\\u5e02\\u6a2a\\u5c97\\u901f\\u9012\\u8425\\u9500\\u90e8\\u5df2\\u6536\\u4ef6\\uff0c\\uff08\\u63fd\\u6295\\u5458\\u59d3\\u540d\\uff1a\\u949f\\u67d0\\u67d0;\\u8054\\u7cfb\\u7535\\u8bdd\\uff1a18000000000\\uff09\\",
                                \\"AcceptTime\\":\\"2017-01-18 10:41:59\\"
                            }');


//echo $RequestData;

//echo date('Y-m-d H:m:s');

exit;
require 'vendor/' . 'autoload.php';

use Pheanstalk\Pheanstalk;

$pheanstalk = new Pheanstalk('127.0.0.1');


$pheanstalk->useTube('testtube')->put('job playload goes here\h');
$pheanstalk->useTube('testtube')->put('zz\h');
$pheanstalk->useTube('testtube')->put('jj\h');

$job = $pheanstalk->watch('testtube')->ignore('default')->reserve();

echo $job->getData();

$pheanstalk->delete($job);

$pheanstalk->getConnection()->isServiceListening();

exit;
class A
{
    private static $sfoo = 1;

    private $ifoo = 2;

}

$cli1 = static function() {
    //return A::$sfoo;
};

$cli2 = function () {
    return $this->ifoo;
};

$bcl1 = Closure::bind($cli1, null, 'A');
$bcl2 = Closure::bind($cli2, new A(), 'A');

echo $bcl1() , "\n";
echo $bcl2() , "\n";

//class A {
//    private static $sfoo = 1;
//    private $ifoo = 2;
//}
//$cl1 = static function() {
//    return A::$sfoo;
//};
//$cl2 = function() {
//    return $this->ifoo;
//};
//
//$bcl1 = Closure::bind($cl1, null, 'A');
//$bcl2 = Closure::bind($cl2, new A(), 'A');
//echo $bcl1(), "\n";
//echo $bcl2(), "\n";