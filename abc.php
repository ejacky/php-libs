<?php
function tick_handler()
{
    echo "tick_handler() called\n";
}

$a = 1;
tick_handler();

if ($a > 0) {
    $a += 2;
    tick_handler();
    print($a);
    tick_handler();
}
tick_handler();
exit;
declare(ticks=1);

function tick_handler2()
{
    echo "tick_handler() called\n";
}

register_tick_function('tick_handler');

$a = 1;

if ($a > 0) {
    $a += 2;
    print($a);
}
exit;

class Foo3
{
    public $var = '3.1415962654';
}

for ( $i = 0; $i <= 1000000; $i++ )
{
    $a = new Foo3;
    $a->self = $a;
}

echo memory_get_peak_usage(), "\n";

exit;
class Foo2
{
    public $var = '3.1415962654';
}

$baseMemory = memory_get_usage();

for ( $i = 0; $i <= 100000; $i++ )
{
    $a = new Foo2;
    $a->self = $a;
    if ( $i % 500 === 0 )
    {
        echo sprintf( '%8d: ', $i ), memory_get_usage() - $baseMemory, "\n";
    }
}

exit;
echo memory_get_usage() . "\n"; // 36640

$a = str_repeat("Hello", 4242);

echo memory_get_usage() . "\n"; // 57960

unset($a);

echo memory_get_usage() . "\n"; // 36744

echo memory_get_peak_usage();
exit;
class Foo
{
    public $var = '3.1415962654';
}

for ( $i = 0; $i <= 1000000; $i++ )
{
    $a = new Foo;
    $a->self = $a;
}

echo memory_get_peak_usage(), "\n";

exit;
$a = array( 'one' );
$a[] =& $a;
xdebug_debug_zval( 'a' );
exit;
$key = ftok(__FILE__, 'h');
$mode = 'c';
$permissions = 0644;
$size = 1024;

$shmid = shmop_open($key, $mode, $permissions, $size);

var_dump($shmid);

exit;
$bar = 'BAR';
apc_add('foo', $bar);
var_dump(apc_fetch('foo'));

exit;
function foo(&$var)
{
    $var++;
}

function &bar()
{
    $a = 5;
    return $a;
}

//echo foo(bar());
//
//echo foo($a = 5);
//echo foo($a);

foo(bar());

exit;

function foo2(&$var)
{
    $var++;
}

$a = 5;
foo2($a);

var_dump($a);

exit;

try {
    try {
        throw new RuntimeException('ss');
   } catch (OutOfRangeException $e) {
        echo "yyy";
        echo $e->getMessage();
    }
} catch (RuntimeException $e) {
    echo "xxxx";
    echo $e->getMessage();

}

exit;
class PostRepository
{
    public function count()
    {
        return "this is postrepository:count";
    }

}

class PostController
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
}

$class = new ReflectionClass('PostController');
$constructor = $class->getConstructor();
//var_dump($constructor);
//var_dump($constructor->getParameters());

$parameters = $constructor->getParameters();
$dependencies = [];

foreach ($parameters as $parameter) {
    $concrete = $parameter->getClass()->name;
    $dependencies[] = new $concrete;
}

var_dump($class->newInstanceArgs($dependencies));


exit;



print_r(get_defined_constants(true));

exit;
function foo1()
{
    $numargs = func_num_args();
    echo "Number of arguments: $numargs<br />\n";
    if ($numargs >= 2) {
        echo "Second argument is: " . func_get_arg(1) . "<br />\n";
    }
    $arg_list = func_get_args();
    for ($i = 0; $i < $numargs; $i++) {
        echo "Argument $i is: " . $arg_list[$i] . "<br />\n";
    }
}

foo1(1, 2, 3);
