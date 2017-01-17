<?php
class AliasLoader
{
    protected static $instance;

    public function load()
    {
        echo "test";
        return "abc";
    }

    public function register()
    {
        spl_autoload_register([$this, 'load'], true, true);
    }

    public static function getInstance(array $alias = [])
    {
        if (is_null(static::$instance)) {
            return static::$instance = new static($alias);
        }

        return static::$instance;
    }

    private function __construct()
    {

    }

}

function my_autoloader($class) {
   // include 'classes/' . $class . '.class.php';
    echo "zhangzhang";
}

spl_autoload_register('my_autoloader');



//AliasLoader::getInstance(['abc'])->register();