<?php
namespace Decorator;

// use Attributes;
use Decorator\Libraries\Method;
use ReflectionClass;
use ReflectionMethod;

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
     * @param $input
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
        // var_dump($matches);

        if ($matches[self::DECORATOR] === 'method') {
            $method       = new Method($matches);
            $validMethods = [];
            if (!empty($matches[3])) {
                $validMethods = explode(',', $matches[3]);

                foreach ($validMethods as $key => &$value) {
                    $value = trim($value);
                }

                $method->setMethod($this->inputMethod);
                $method->setValidMethods($validMethods);
            }
            if ($method->isValid()) {
                return $refMethod->invoke($this->class);
            }
        } else if ($matches[self::DECORATOR] === 'auth') {
            // Do Auth-stuff
        }

    }

    /**
     * @param $attr
     * @return mixed
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
