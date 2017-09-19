<?php

namespace Decorator\Lib;

interface DecoratorInterface
{
    /**
     * @var array $matches Must contain matches from ReadDoc.
     * @return void
     */
    public function __construct(array $matches);

    /**
     * @return boolean
     */
    public function isValid();
}
