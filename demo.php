<?php
require 'vendor/' . 'autoload.php';

use Pheanstalk\Pheanstalk;

$pheanstalk = new Pheanstalk('192.168.1.233');


$pheanstalk->useTube('testtube')->put('job playload goes here\h');

$job = $pheanstalk->watch('testtube')->ignore('default')->reserve();

echo $job->getData();

exit;
class A
{
    private static $sfoo = 1;

    private $ifoo = 2;

}

$cli1 = static function() {
    return A::$sfoo;
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