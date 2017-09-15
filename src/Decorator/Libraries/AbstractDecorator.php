<?php

namespace Decorator\Libraries;

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
