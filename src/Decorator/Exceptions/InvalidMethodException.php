<?php

namespace Decorator\Exceptions;

use Exception;

class InvalidMethodException extends Exception
{
    /**
     * @var int
     */
    const ERROR_CODE = 405;

    /**
     * @var string
     */
    const ERROR_MSG = 'Expected (%s), but got %s instead.';

    /**
     * @param $message
     * @param $code
     * @param Exception $previous
     */
    public function __construct(
        array $methods, int $code = 0, Exception $previous = null
    ) {
        $message = sprintf(
            self::ERROR_MSG,
            implode(',', $methods[0]),
            $methods[1]
        );

        // make sure everything is assigned properly
        parent::__construct($message, self::ERROR_CODE, $previous);
    }

    public function __toString()
    {
        return sprintf('%s:[%d]: %s', __CLASS__, $this->code, $this->message);
    }
}
