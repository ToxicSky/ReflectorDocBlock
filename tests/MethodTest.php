<?php
use PHPUnit\Framework\TestCase;

require_once './Test.php';

class MethodTest extends TestCase
{
    public function testGet()
    {
        $test = new Test;
        $this->assertEquals('GET', $test->methodGetTest());
    }

    /**
     * @expectedException \Decorator\Exceptions\InvalidMethodException
     */
    public function testPost()
    {
        $test = new Test;
        $test->methodPostTest();
    }
}
