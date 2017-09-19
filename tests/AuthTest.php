<?php
use PHPUnit\Framework\TestCase;

require_once './Test.php';
session_start();
class AuthTest extends TestCase
{
    public function testAuth()
    {
        $_SESSION['email']  = 'admin@example.com';
        $_SESSION['active'] = 1;

        $test = new Test;
        $this->assertTrue($test->methodAuthTest());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAuthFail()
    {
        $_SESSION['email']  = 'admin@example.com';
        $_SESSION['active'] = 0;

        $test = new Test;
        $test->methodAuthTest();
    }
}
