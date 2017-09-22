<?php
namespace Decorator\Lib;

use DomainException;
use UnexpectedValueException;

final class Config
{
    const DEFAULT_CONFIG_PATH = './decorator.ini';

    /**
     * @var string
     */
    static private $_configFile;

    /**
     * @return mixed
     */
    public static function get(string $specific = '')
    {
        if (!isset(self::$_configFile)) {
            self::$_configFile = self::DEFAULT_CONFIG_PATH;
        }

        self::_fileExists();
        $config = parse_ini_file(self::$_configFile, true);

        if (strlen($specific) > 0 && isset($config[$specific])) {
            return $config[$specific];
        } else if (strlen($specific) === 0) {
            return $config;
        } else {
            throw new UnexpectedValueException(
                sprintf('Could not find any configuration for %s', $specific)
            );
        }
    }

    public static function set(string $file = '')
    {
        self::$_configFile = $file;
        self::_fileExists();

    }

    private static function _fileExists()
    {
        if (!file_exists(self::$_configFile)) {
            throw new DomainException(
                'Could not find decorator.ini in root-directory'
            );
        }
    }
}
