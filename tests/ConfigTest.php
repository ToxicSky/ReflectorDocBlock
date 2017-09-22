<?php
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * @expectedException DomainException
     */
    public function testSetFalseConfig()
    {
        \Decorator\Lib\Config::set('./falseInit.ini');
    }

    public function testSetConfig()
    {
        $result = \Decorator\Lib\Config::set('./decorator.ini');
        $this->assertInternalType('null', $result);
    }

    /**
     * @depends testSetConfig
     */
    public function testGetConfig()
    {
        $config = \Decorator\Lib\Config::get();
        $this->assertInternalType('array', $config);
    }
}
