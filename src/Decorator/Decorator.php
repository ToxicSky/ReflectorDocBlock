<?php

namespace Decorator;

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
