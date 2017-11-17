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
        $this->red = $this->create_redis();

        $this->init_log();
    }

    private function init_log()
    {
        $this->log = new Monolog\Logger('my-log');
        $this->log->pushHandler(new Monolog\Handler\StreamHandler(__DIR__.'/my.log', Monolog\Logger::DEBUG));
        $this->log->pushHandler(new Monolog\Handler\FirePHPHandler());
    }

    public function create_redis()
    {
        if (!$this->red) {
            $this->red = new Predis\Client();
        }
        return $this->red;
    }

    public function parse_time($id)
    {
        $time = intval($id) * 60;
        $time_str = date('Y-m-d H:i', $time);
        echo $time_str;
    }

    public function record_policy_log($mid, $data)
    {
        $record_time = $this->faker->unixTime();
        $data['time'] = $record_time;
        $stat_slot_key = floor($record_time / 60);
        $exist_key = $this->red->hexists('client_policy_stats', $stat_slot_key);
        $this->red->pipeline(function ($pipe) use($stat_slot_key, $mid, $data, $exist_key) {
            $pipe->hset('client_policy', $mid, json_encode($data));
            $pipe->hincrby('client_policy_stats', $stat_slot_key, 1);
            if ($exist_key == 0) {
                $pipe->lpush('client_policy_time_series', $stat_slot_key);
            }

            $data['mid'] = $mid;
            $pipe->lpush('client_policy_fetch_data_' . $stat_slot_key, json_encode($data));

        });
    }

    public function clean_policy_cache()
    {
        $expire_time = floor((time() - 1 * 24 * 60 * 60) / 60);
        while (true) {
            $len = $this->red->llen('client_policy_time_series');
            if ($len <= 0) {
                echo "为空";
                break;
            }

            $time_slot_key = $this->red->lindex('client_policy_time_series', $len - 1);
            if ($time_slot_key < $expire_time) {
                try {
                    $this->red->pipeline(function ($pipe) use($time_slot_key) {
                        $pipe->rpop('client_policy_time_series');
                        $pipe->hdel('client_policy_stats',  array($time_slot_key));
                        $pipe->del(array('client_policy_fetch_data_' . $time_slot_key));
                    });
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                echo "已清空";
                break;
            }
        }
    }

    public function test_faker()
    {
        $len = $this->red->llen('client_policy_time_series');
        $time_slot_key = $this->red->lindex('client_policy_time_series', $len - 1);
        echo $time_slot_key;
        //echo json_encode($this->fuck_test());
//        echo time();
//        echo PHP_EOL;
//        echo $this->faker->unixTime();
//        echo PHP_EOL;
//        echo $this->faker->md5;
    }

    public function my_test()
    {
        //$this->red->set('laozhang', 'zzzzzzzzzzzzzzzzzzz');
        //$this->red->del(array('laozhang'));
        //$this->red->hdel('');
    }

    public function fuck_test()
    {
        $this->red->lpush();
        $mid = $this->faker->md5;
        $data = array(
            'time' => $this->faker->unixTime,
            'mid' => $mid,
            'server_info' => array(
                $this->faker->word => array('conf_ver' => $this->faker->unixTime())
            )
        );
        $this->record_policy_log($mid, $data);
    }
}

$my = new My();
$my->parse_time('25180324');
echo date('Y-m-d H:i');
//$my->clean_policy_cache();
//$my->record_policy_log();
//$my->my_test();