<?php
include "vendor/autoload.php";

use Pheanstalk\Pheanstalk;

$pheanstalk = new Pheanstalk('10.98.2.115');
$faker = Faker\Factory::create();

//$pheanstalk->useTube('testtube')->put('job playload goes here\h');
//$pheanstalk->useTube('testtube')->put('zz\h');
//$pheanstalk->useTube('testtube')->put('jj\h');

//$job = $pheanstalk->watch('testtube')->ignore('default')->reserve();

//$i = 0;
while (true) {
    $msg        = array(
        'msg_type' => 'hostinfo',
        'mac'    => $faker->macAddress,
        'mid'   => $faker->md5,
        's_ip'  => $faker->ipv4

    );
    $pheanstalk->useTube('work_queue_nac_device_info')->put(json_encode($msg));
    //$i++;
}

exit;

var_dump($job);
//echo $job->getData();
//var_dump($pheanstalk->statsJob($job));

$pheanstalk->bury($job);
//$pheanstalk->delete($job);
//
//$pheanstalk->getConnection()->isServiceListening();