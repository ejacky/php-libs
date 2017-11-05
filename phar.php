<?php

//$phar = new Phar('t_p.phar');
//$phar->buildFromDirectory(__DIR__ . '/test', '/\.php$/');
//$phar->setStub($phar->createDefaultStub('a.php'));

include "t_p.phar";

$a = new a();
$a->a_t();