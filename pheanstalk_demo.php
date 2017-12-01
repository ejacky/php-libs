<?php
include "vendor/autoload.php";

use Pheanstalk\Pheanstalk;

$pheanstalk = new Pheanstalk('10.98.2.115');
$red_cli = new \Predis\Client('tcp://10.98.2.115:6379');
$faker = Faker\Factory::create();
//
//if (class_exists('Tideways\Profiler')) {
//    echo "hello world";
//    \Tideways\Profiler::start(array(
//        'api_key' => 'YOUR API KEY',
//        'sample_rate' => 25,
//        'framework' => 'OPTIONAL; See below',
//    ));
//
//
//}
//
//
//if (class_exists('Tideways\Profiler')) {
//    \Tideways\Profiler::stop();
//}

//$pheanstalk->useTube('testtube')->put('job playload goes here\h');
//$pheanstalk->useTube('testtube')->put('zz\h');
//$pheanstalk->useTube('testtube')->put('jj\h');

//$job = $pheanstalk->watch('testtube')->ignore('default')->reserve();

//$i = 0;




function foo() {
    echo "hello";
}
$i = 0;
while ($i < 5) {
    $content = file_get_contents('tmp/nac_deviceinfo.json');
    $cont_arr = json_decode($content, true);
    $cont_arr['mac'] = $faker->macAddress;
    $pheanstalk->useTube('work_queue_nac_device_info')->put(json_encode($cont_arr));
    $i++;
}

exit;

var_dump($job);
//echo $job->getData();
//var_dump($pheanstalk->statsJob($job));

$pheanstalk->bury($job);
//$pheanstalk->delete($job);
//
//$pheanstalk->getConnection()->isServiceListening();