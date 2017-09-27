<?php

use Decorator\Decorator;

class Test
{
    use Decorator;

    /**
     * @method(get)
     */
    protected function methodGetTest()
    {
        return 'GET';
    }

    /**
     * @method(post)
     */
    protected function methodPostTest()
    {
        return 'POST';
    }

    /**
     * @authRequired
     */
    protected function methodAuthTest()
    {
        return true;
    }

    /**
     * @method(post)
     */
    public function methodNoDecorator()
    {
        echo 'Hello, World!' . PHP_EOL;
        return true;
    }
}
