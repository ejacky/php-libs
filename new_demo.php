<?php
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