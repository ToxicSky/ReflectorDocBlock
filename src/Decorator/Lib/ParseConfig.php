<?php
namespace Decorator\Lib;

use DomainException;
use UnexpectedValueException;

final class ParseConfig
{
    const DEFAULT_CONFIG_PATH = './decorator.ini';

    /**
     * @var mixed
     */
    private $_config;

    /**
     * @return mixed
     */
    public static function get(string $specific = '')
    {
        self::_fileExists();
        $config = parse_ini_file(self::DEFAULT_CONFIG_PATH, true);

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

    private static function _fileExists()
    {
        if (!file_exists(self::DEFAULT_CONFIG_PATH)) {
            throw new DomainException(
                'Could not find decorator.ini in root-directory'
            );
        }
    }
}
