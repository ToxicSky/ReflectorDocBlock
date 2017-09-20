<?php

namespace Decorator\Lib\RequestMethods;

use Decorator\Exceptions\InvalidMethodException;
use Decorator\Lib\AbstractDecorator;
use Decorator\Lib\DecoratorInterface;

class Method extends AbstractDecorator implements DecoratorInterface
{
    /**
     * @var mixed
     */
    private $method;

    /**
     * @var mixed
     */
    private $_validMethods;

    /**
     * @var mixed
     */
    private $_isValid;

    /**
     * @var mixed
     */
    private $matches;

    /**
     * @param $matches
     */
    public function __construct(array $matches)
    {
        $this->matches = $matches;
    }

    /**
     * @param $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function setValidMethods()
    {
        if (!empty($this->matches[3])) {
            $this->_validMethods = $this->parseAttributes($this->matches[3]);
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
        if (in_array($this->method, $this->_validMethods)) {
            $this->_isValid = true;
        } else {
            $this->_isValid = false;
            $msg            = 'Expected (%s), but got %s instead.';
            throw new InvalidMethodException(
                [$this->_validMethods, $this->method]
            );
        }
    }
}
