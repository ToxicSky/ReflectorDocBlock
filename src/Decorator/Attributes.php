<?php

namespace Decorator;

class Attributes
{
    /**
     * @var string
     */
    private $attr;

    /**
     * @var array
     */
    private $attributes = [
        'method',
    ];

    /**
     * @param str|null $attr
     */
    public function __construct($attr = null)
    {
        $this->attr = $attr;
    }

    /**
     * @return array
     */
    public function get()
    {
        return $this->attributes;
    }

    /**
     * @param $method
     */
    public function __getStatic($method)
    {
        var_dump($method);
    }
}
