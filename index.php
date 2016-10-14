<?php
require_once 'vendor/autoload.php';

use Pimple\Container;


class FooProvider implements Pimple\ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        // register some services and parameters
        // on $pimple
        echo "abc";
    }
}

class TestProvider implements Pimple\ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        // register some services and parameters
        // on $pimple
        echo "test";
    }
}

class Session {

    public $a = 'a';

}

$container = new Container();

$container['session'] = function ($c) {
    return new Session($c['session_storage']);
};

$sessionFunction = $container->raw('session');
var_dump($sessionFunction);

//$container->register(new FooProvider());
//
//$container->register(new TestProvider());
