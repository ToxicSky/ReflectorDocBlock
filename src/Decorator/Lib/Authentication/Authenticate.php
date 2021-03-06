<?php
namespace Decorator\Lib\Authentication;

use Decorator\Exceptions\AuthenticationException;
use Decorator\Lib\DecoratorInterface;
use Decorator\Lib\Config;

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
     * @var string
     */
    private $_driver;

    /**
     * @param array $matches
     */
    public function __construct(array $matches)
    {
        $this->_matches = $matches;
        $this->_config  = Config::get('authentication');
        $this->setDriver($this->_config['driver']);
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
     * @throws AuthenticationException
     *
     * @return boolean
     */
    private function validateSession()
    {
        $values = [];
        $session = null;
        $this->setDriver($this->_config['driver']);

        if ($this->_driver === null) {
            $session = $_SESSION;
        } else if ($this->_driver === Illuminate\Support\Facades\Auth::class) {
            return Illuminate\Support\Facades\Auth::check();
        }

        foreach ($this->_config as $key => $config) {
            if ($key === 'driver') {continue;}
            $pos = strpos($key, '.');
            if ($pos !== false) {
                $configKey                          = substr($key, 0, $pos);
                $values[$this->_config[$configKey]] = $config;
                continue;
            }

            if (!isset($session[$config])) {
                throw new AuthenticationException();
            }
        }

        foreach ($values as $key => $value) {
            if (isset($session[$key])) {
                if (strpos($value, 're:') !== false) {
                    $value = explode(':', $value)[1];
                    if (!preg_match($value, $session[$key])) {
                        throw new AuthenticationException();
                    }
                } else if ($session[$key] != $value) {
                    throw new AuthenticationException();
                }
            }
        }
        return true;
    }

    /**
     * @param string $driver
     * @return void
     */
    private function setDriver(string $driver)
    {
        $driver = strtolower($driver);
        if ($driver === 'laravel') {
            $this->_driver = \Illuminate\Support\Facades\Auth::class;
        } else {
            $this->_dirver = null;
        }
    }
}
