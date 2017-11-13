<?php
include 'vendor/' . 'autoload.php';

use Pheanstalk\Pheanstalk;

$pheanstalk = new Pheanstalk('127.0.0.1');


//$pheanstalk->useTube('testtube')->put('job playload goes here\h');
//$pheanstalk->useTube('testtube')->put('zz\h');
//$pheanstalk->useTube('testtube')->put('jj\h');

$job = $pheanstalk->watch('testtube')->ignore('default')->reserve();

var_dump($job);
//echo $job->getData();
//var_dump($pheanstalk->statsJob($job));

$pheanstalk->bury($job);
//$pheanstalk->delete($job);
//
//$pheanstalk->getConnection()->isServiceListening();