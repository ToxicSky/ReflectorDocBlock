<?php
namespace Decorator\Lib\Authentication;

use Decorator\Lib\DecoratorInterface;
use Decorator\Lib\ParseConfig;
use DomainException;
use InvalidArgumentException;

class Authenticate implements DecoratorInterface
{
    /**
     * @var array
     */
    private $_matches;

    /**
     * @var mixed
     */
    private $_config;

    /**
     * @var mixed
     */
    private $_user;

    /**
     * @param array $matches
     */
    public function __construct(array $matches)
    {
        $this->_matches = $matches;
        $this->_config  = ParseConfig::get('authentication');
    }

    /**
     * @return boolean
     */
    public function isValid()
    {
        return $this->validateSession();
    }

    /**
     * Validates a session to see that all variables are there.
     * Will nto make any calls to db at the current moment.
     *
     * @throws InvalidArgumentException
     * @throws DomainException
     *
     * @return boolean
     */
    private function validateSession()
    {
        $values = [];
        foreach ($this->_config as $key => $config) {
            $pos = strpos($key, '.');
            if ($pos !== false) {
                $configKey                          = substr($key, 0, $pos);
                $values[$this->_config[$configKey]] = $config;
                continue;
            }

            if (!isset($_SESSION[$config])) {
                throw new DomainException('Change this...');
            }
        }

        foreach ($values as $key => $value) {
            if (isset($_SESSION[$key])) {
                if (strpos($value, 're:') !== false) {
                    $value = explode(':', $value)[1];
                    if (!preg_match($value, $_SESSION[$key])) {
                        throw new InvalidArgumentException(
                            sprintf('Invalid value provided to key "%s"', $key)
                        );
                    }
                } else if ($_SESSION[$key] != $value) {
                    throw new InvalidArgumentException(
                        sprintf('Invalid value provided to key "%s"', $key)
                    );
                }
            }
        }
        return true;
    }
}
