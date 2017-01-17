<?php
/**
 * User: shenzhe
 * Date: 13-6-17
 * 
 */


namespace ZPHP\View\Adapter;
use ZPHP\View\Base,
    ZPHP\Common\Utils,
    ZPHP\Core\Config;

class Amf extends Base
{
    public function display()
    {
        if (Config::get('server_mode') == 'Http') {
            Utils::header('Content-Type', 'application/amf; charset=utf-8');
            echo \amf3_encode($this->model);
        } else {
        	return \amf3_encode($this->model);
        }
        
    }
}