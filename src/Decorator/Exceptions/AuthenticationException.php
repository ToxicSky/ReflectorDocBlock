<?php

namespace Decorator\Exceptions;

use Exception;

class AuthenticationException extends Exception
{
    /**
     * @var int
     */
    const ERROR_CODE = 401;

    /**
     * @var string
     */
    const ERROR_MSG = 'Authentication failed.';

    /**
     * @param $message
     * @param $code
     * @param Exception $previous
     */
    public function __construct(
        string $methods = '', int $code = 0, Exception $previous = null
    ) {
        // make sure everything is assigned properly
        parent::__construct(self::ERROR_MSG, self::ERROR_CODE, $previous);
    }

    public function __toString()
    {
        return sprintf('%s:[%d]: %s', __CLASS__, $this->code, $this->message);
    }
}
