<?php
namespace Decorator;

use Decorator\Lib\Authentication\Authenticate;
use Decorator\Lib\RequestMethods\Method;
use ReflectionClass;
use ReflectionMethod;

/**
 * Parses the docblock above the called class and calls classes
 * related to the decoration, if any.
 */
class ReadDoc
{
    const DECORATOR = 'decorator';

    /**
     * @var string
     */
    private $pattern = '/\@(?P<decorator>[a-z]+)(\(([a-z-0-9-,\s]+)\))?/';

    /**
     * @var mixed
     */
    private $class;

    /**
     * @var string Should contain the method used by the call.
     */
    private $inputMethod;

    /**
     * @param $class
     */
    public function __construct($class)
    {
        $this->class = $class;
        if (isset($_SERVER['REQUEST_METHOD'])) {
            $this->inputMethod = $_SERVER['REQUEST_METHOD'];
        }
    }

    /**
     * @throws \Exception
     *
     * @param $input
     * @return \ReflectionMethod|void
     */
    public function parse($method)
    {
        // This is just a static variable for mockup.
        $this->inputMethod = strtolower('GET');

        $attr = new Attributes();

        $reflector = new ReflectionClass($this->class);
        $refMethod = new ReflectionMethod($this->class, $method);
        $refMethod->setAccessible(true);
        $docBlock = $reflector->getMethod($method)->getDocComment();

        preg_match($this->pattern, $docBlock, $matches);

        if(!isset($matches[self::DECORATOR])) {
            return $refMethod->invoke($this->class);
        }

        $valid = false;
        if ($matches[self::DECORATOR] === 'method') {
            $method = new Method($matches);
            $method->setMethod($this->inputMethod);
            $method->setValidMethods();

            $valid = $method->isValid();
        } else if ($matches[self::DECORATOR] === 'auth') {
            $auth  = new Authenticate($matches);
            $valid = $auth->isValid();
        }

        if ($valid) {
            return $refMethod->invoke($this->class);
        }

    }

    /**
     * @param $attr
     * @return array
     */
    private function parseAttributes($attr)
    {
        $attr       = explode(',', $attr);
        $attributes = [];
        foreach ($attr as $str) {
            $attributes[] = trim(strtolower($str));
        }
        return $attributes;
    }
}
