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
        return 'This should be visible if GET.';
    }

    /**
     * @method(post)
     */
    protected function methodPostTest()
    {
        return 'This should be visible if POST.';
    }

    /**
     * @authRequired
     */
    protected function methodAuthTest()
    {
        return 'Auth required!';
    }
}
