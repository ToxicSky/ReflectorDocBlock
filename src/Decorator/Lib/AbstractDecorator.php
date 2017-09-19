<?php

namespace Decorator\Lib;

abstract class ABstractDecorator
{
    /**
     * @param $attr
     * @return mixed
     */
    protected function parseAttributes($attr)
    {
        $attr       = explode(',', $attr);
        $attributes = [];
        foreach ($attr as $str) {
            $attributes[] = trim(strtolower($str));
        }
        return $attributes;
    }
}
