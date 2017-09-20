<?php

namespace Decorator\Lib;

final class Database
{
    /**
     * @var array
     */
    private $_config;

    /**
     * @var string
     */
    private $_dbClass;

    public function __construct()
    {
        $this->_config = ParseConfig::get('database');
    }

    /**
     * @throws \PDOException
     * @return boolean
     */
    private function testConnection()
    {}

    /**
     * @return mixed
     */
    private function identify()
    {
        $class = null;
        if (class_exists(Illuminate\Database\Eloquent\Model::class)) {
            $class = Illuminate\Database\Eloquent\Model::class;
        } else if (class_exists(Zend\Db\Adapter\Adapter::class)) {
            $class = Zend\Db\Adapter\Adapter::class;
        }

        $this->_dbClass = $class;
    }
}
