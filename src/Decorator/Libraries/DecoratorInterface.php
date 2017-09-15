<?php

namespace Decorator\Libraries;

interface DecoratorInterface
{
    /**
     * @var array $matches Must contain matches from ReadDoc.
     * @return void
     */
    public function __construct($matches);

    /**
     * @return boolean
     */
    public function isValid();
}
