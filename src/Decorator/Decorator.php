<?php

namespace Decorator;

use ReflectionClass;
use ReflectionMethod;

trait Decorator
{
    /**
     * @param $name
     * @param $args
     */
    public function __call($name, $args)
    {
        $rd     = new ReadDoc($this);
        $result = $rd->parse($name);
        return $result;
    }
}
