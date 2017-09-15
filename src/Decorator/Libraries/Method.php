<?php

namespace Decorator\Libraries;

use Decorator\Attributes;
use InvalidArgumentException;

class Method extends AbstractDecorator implements DecoratorInterface
{
    /**
     * @var mixed
     */
    private $method;

    /**
     * @var mixed
     */
    private $validMethods;

    /**
     * @var mixed
     */
    private $_isValid;

    /**
     * @var mixed
     */
    private $matches;

    /**
     * @var mixed
     */
    private $attributes;

    /**
     * @param $matches
     */
    public function __construct($matches)
    {
        $this->attributes = new Attributes;
        $this->matches    = $matches;
    }

    /**
     * @param $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @param $methods
     */
    public function setValidMethods($methods)
    {
        if (isset($this->matches[3])) {
            $this->validMethods = $this->parseAttributes($this->matches[3]);
        }
    }

    /**
     * @return mixed
     */
    public function isValid()
    {
        $this->validate();
        return $this->_isValid;
    }

    /**
     * @return mixed
     */
    private function validate()
    {
        if (in_array($this->method, $this->validMethods)) {
            $this->_isValid = true;
        } else {
            $this->_isValid = false;
            $msg            = 'Expected (%s), but got %s instead.';
            throw new InvalidArgumentException(
                sprintf($msg, implode(',', $this->validMethods), $this->method)
            );
        }
    }
}
