<?php
//date_default_timezone_set('Asia/Shanghai');

//$test['for_test']['order'] = 100;
//var_dump($test);
//
//exit;

/**
 * 1 default value
 * 2  digui order
 */


$a = array(
    'for_test' => array(
        'name' => '测试',
        'items' => array('name' => 'ce', 'order' => 0)
    ),

    'home_page' => array(
        'order' => 30,
        'name' => '首页',
        'items' => array(
            'index' => array('name' => '首页', 'order' => 10),
        )
    ),
    'client_mgr' => array(
        'order' => 40,
        'name'  => '终端管理',
        'items' => array(
            'cli_summary' => array('order' => 30, 'name' => '终端概况'),
            'virus_sec'  => array('order' => 20, 'name' => '病毒查杀'),
            'leak_mgr'   => array('order' => 10, 'name' => '漏洞管理', 'sub_items' => array('leak_mgr_cli' => array('name' => '按终端显示', 'order' => 20, 'action' => 'byterminal'), 'leak_mgr_cli_item' => array('name' => '按漏洞显示', 'order' => 10, 'action' => 'byitem')))
        )
    ),
    'device_mgr' => array(
        'order' => 20,
        'name' => '设备管理',
        'items' => array(
            'usb_mgr' => array('order' => 10, 'name' => '移动存储')
        )
    ),


);

//$order_array =  usort($a, function ($a, $b) {
//    return $a['order'] - $b['order'];
//});

//uasort($a, function ($a, $b) {
//    return $a['order'] - $b['order'];
//});
//
//var_dump(json_encode($a));
//
//foreach ($a as &$item) {
//    if (isset($item['items'])) {
//        uasort($item, function ($a, $b) {
//            return $a['order'] - $b['order'];
//        });
//    }
//}
//
//var_dump(json_encode($a));

//exit;
//
//function array_ex_sort(&$r_array)
//{
//    // 给第一级排序
//    uasort($r_array, function ($a, $b) {
//        return $a['order'] - $b['order'];
//    });
//
//    // 排序第二级
//    foreach ($r_array as &$item) {
//        if (isset($item['items'])) {
//            uasort($item['items'], function ($a, $b) {
//                return $a['order'] - $b['order'];
//            });
//        }
//
//        // 排序第三级
//        foreach ($item as &$sub_item) {
//            if (isset($sub_item['sub_items'])) {
//                uasort($sub_item['sub_items'], function ($a, $b) {
//                    return $a['order'] - $b['order'];
//                });
//            }
//
//        }
//    }
//}
//array_ex_sort($a);
function array_ex_sort_2(&$r_array, $sort_field = 'order')
{
    uasort($r_array, function ($a, $b) use($sort_field) {

        return $a[$sort_field] - $b[$sort_field];
    });
    foreach ($r_array as &$item) {
        if (is_array($item) ) {
            array_ex_sort_2($item);
        }
    }
}
array_ex_sort_2($a);
var_dump(json_encode($a));

//$t = array('t' => array('order' => 5));

//usort($t, function($a, $b) {
//    return $a['order'] - $b['order'];
//});
//var_dump($t);exit;
//array_ex_sort($a);
//var_dump($a);

//function array_ex_sort(&$r_array)
//{
//    foreach ($r_array as  &$item) {
//        if (!isset($item['order'])) {
//            //echo "true";
//            //var_dump($item);
//            $item['order'] = 1000;
//        }
//
//        foreach ($item as &$sub_item) {
//            if (!isset($sub_item['order'])) {
//                //echo "true";
//                //var_dump($sub_item);
//                $sub_item['order'] = 1000;
//            }
//
//        }
//        unset($sub_item);
//        usort($item, array("TestObj", "cmp_obj"));
//
//
//    }
//    unset($item);
//    usort($r_array, array("TestObj", "cmp_obj"));
//}


exit;
$a = array(
    'z' => array(
        'n' => 'xx',
        'order' => 20,
        'i' => array(
            'n' => 'ww',
            'order' => 50,
            'ii' => array('n' => 'dd', 'order' => 80)
        )
    ),
    'w' => array(
        'n' => 'yy',
        'order' => 10,
        'i' => array(
            'n' => 'xx',
            'order' => 50,
            'ii' => array('n' => 'ee', 'order' => 70)
        )
    ),
    'l' => array()
);


exit;
if (intval(" ")) {
    echo "yes";

} else {
    echo "falut";
}
exit;
error_reporting(-1);
$value = array(
    'id' => 1023,
    'name' => 'openports_check',
    'white_ports' => "60, 25, 70- 65",
    'black_ports' => "20 ,  50, 2 -9,  40 - 30"
    );
foreach ($value as $k => &$v) {
    if (1023 == $value['id']) {
        if ('white_ports' == $k or 'black_ports' == $k) {
            foreach ($v_array = explode(',', $v) as $kk => &$vv) {
                if (strpos($vv, '-') !== false) {
                    $vv_array = array_map('trim', explode('-', $vv));
                    asort($vv_array);
                    $vv = implode('-', $vv_array);
                } else {
                    $vv = trim($vv);
                }
            }
            unset($vv);
            $v = implode(',',$v_array);
        }
    }
}
print_r($value);
exit;
//backup
if ("1023" == $value["id"]) {
    if ('white_ports' == $k  or 'black_ports' == $k) {
        foreach ($v_array = explode(',', $v) as $kk => &$vv) {
            if (strpos($vv, '-') !== false) {
                $vv_array = array_map('trim', explode('-', $vv));
                asort($vv_array);
                $vv = implode('-', $vv_array);
            } else {
                $vv = trim($vv);
            }
        }
        unset($vv);
        $v = implode(',',$v_array);
    }
}

exit;
foreach ($v as $kk => &$vv) {
    if (strpos($vv, '-') !== false) {
        $vv_array = explode('-', $vv);
        $vv_array = array_map('trim', $vv_array);
            asort($vv_array);
        $vv = implode('-', $vv_array);
    } else {
        $vv = trim($vv);
    }
}
unset($vv);

print_r($v);
exit;

$black_ports = array("20 ", " 50", "2 -9", " 40 - 30");
//asort($black_ports);
print_r($black_ports);
foreach ($black_ports as $key => &$value) {
    // 排序端口段
    if (strpos($value, '-') !== false) {
        $value_array = explode('-', $value);

        $value_array = array_map('trim', $value_array);
        print_r(asort($value_array));
        $value = implode('-', $value_array);
    } else {
        $value = trim($value);
    }

}
unset($value);
print_r($black_ports);
exit;

if (extension_loaded('pgsql')) {
    echo "exist;";
} else {
    echo "donot exist";
}


exit;
static $finder = null;

$finder = 'haa';

static $finder = null;

var_dump($finder);
exit;
$dbname = 'skylar';
$host = '127.0.0.1';
$port = '5360';
$dbuser = 'postgres';
$dbpass = 'postgres';
$dbh = new PDO("pgsql:dbname=$dbname;host=$host;port=$port", $dbuser, $dbpass);
var_dump($dbh);
exit;


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