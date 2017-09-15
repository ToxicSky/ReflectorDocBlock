<?php
require __DIR__ . '/vendor/autoload.php';
// require_once 'Decorator/Attributes.php';
// require_once 'Decorator/ReadDoc.php';
// require_once 'Decorator/Decorator.php';
require_once 'Test.php';

$test = new Test;
try {
    var_dump($test->methodGetTest());
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    echo PHP_EOL;
}
try {
    var_dump($test->methodPostTest());
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    echo PHP_EOL;
}

try {
    var_dump($test->methodAuthTest());
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    echo PHP_EOL;
}
