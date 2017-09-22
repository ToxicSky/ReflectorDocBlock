<?php
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * @expectedException DomainException
     */
    public function testSetConfig()
    {
        \Decorator\Lib\Config::set('./falseInit.ini');
    }

    public function testGetConfig()
    {
        \Decorator\Lib\Config::set('./decorator.ini');
        $config = \Decorator\Lib\Config::get();
        $this->assertInternalType('array', $config);
    }
}
