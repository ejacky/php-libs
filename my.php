<?php

include "vendor/autoload.php";

class My
{
    private  $red;
    private $faker;
    private $log;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
        $this->red_cli = $this->createRedis();

        $this->init();
    }

    private function init()
    {
        $this->initConfig();
        $this->initLog();
    }

    private function initConfig()
    {
        date_default_timezone_set('Asia/Shanghai');
    }
    private function initLog()
    {
        $this->log = new Monolog\Logger('my-log');
        $this->log->pushHandler(new Monolog\Handler\StreamHandler(__DIR__.'/my.log', Monolog\Logger::DEBUG));
        $this->log->pushHandler(new Monolog\Handler\FirePHPHandler());
    }

    public function createRedis()
    {
        if (!$this->red) {
            $this->red = new Predis\Client();
        }
        return $this->red;
    }

    public function parseTime($id)
    {
        $time = intval($id) * 60;
        $time_str = date('Y-m-d H:i', $time);
        echo $time_str;
    }

    public function cleanPolicyCache()
    {
        $expire_time = floor((time() - 60) / 60);
        while (true) {
            $len = $this->red_cli->llen('client_policy_time_series');
            if ($len <= 0)
                break;

            $time_slot_key = $this->red_cli->lindex('client_policy_time_series', $len - 1);
            if ($time_slot_key < $expire_time) {
                $this->red_cli->pipeline(function ($pipe) use($time_slot_key) {
                    $pipe->rpop('client_policy_time_series');
                    $pipe->hdel('client_policy_stats',  array($time_slot_key));
                    $pipe->del(array('client_policy_fetch_data_' . $time_slot_key));
                });
            }
        }
    }

    public function cleanTest()
    {
        $expire_time = floor((time() - 0.1  * 60 * 60) / 60);
        //$this->red_cli->hdel('client_policy_stats', array('11216321'));
        $this->red_cli->del(array('client_policy_stats'));
//        while (true) {
//            $len = $this->red_cli->llen('client_policy_time_series');
//            if ($len <= 0)
//                break;
//
//            //$time_slot_key = $this->red_cli->lindex('client_policy_time_series', $len - 1);
//
//            if ($time_slot_key < $expire_time) {
//                //$this->red_cli->hdel('client_policy_stats',  array($time_slot_key));
//                $this->red_cli->del(array('client_policy_fetch_data_' . $time_slot_key));
//            }
//        }
    }


    public function recordPolicyLog($mid, $data, $stat_slot_key)
    {
        $record_time = time();
        $data['time'] = $record_time;
        //$stat_slot_key = floor($record_time / 60);
        $exist_key = $this->red_cli->hexists('client_policy_stats', $stat_slot_key);
        $this->red_cli->pipeline(function ($pipe) use($stat_slot_key, $mid, $data, $exist_key) {
            $pipe->hset('client_policy', $mid, json_encode($data));
            $pipe->hincrby('client_policy_stats', $stat_slot_key, 1);
            if ($exist_key == 0) {
                $pipe->lpush('client_policy_time_series', array($stat_slot_key));
            }

            $data['mid'] = $mid;
            $pipe->lpush('client_policy_fetch_data_' . $stat_slot_key, array(json_encode($data)));
        });
    }

    public function generateFakerData()
    {
        $mid = $this->generateRandomString(25);
        $policy_name = $this->generateRandomString(3);
        $data = array(
            'time' => time(),
            'mid' => $mid,
            'server_info' => array(
                $policy_name => array('conf_ver' => time())
            )
        );

        $i = 0;
        $stat_slot_key = floor((time() - 31 * 24 * 60 * 60) / 60);
        while ($i < 3) {
            $this->recordPolicyLog($mid, $data, $stat_slot_key);
            $stat_slot_key++;
            $i++;
        }
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

$my = new My();
$my->parseTime('25180324');
echo date('Y-m-d H:i');
//$my->generateFakerData();
$my->cleanPolicyCache();
//$my->cleanTest();
//$my->record_policy_log();
//$my->my_test();