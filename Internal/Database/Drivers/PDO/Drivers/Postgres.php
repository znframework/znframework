<?php namespace ZN\Database\Drivers\PDO\Drivers;

use ZN\Database\Drivers\PDO\DriverInterface;

class PDOPostgresDriver implements DriverInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // DNS
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  array $config
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function dsn(Array $config) : String
    {
        $dsn  = 'pgsql:';

        $dsn .= ( ! empty($config['host']) )
                ? 'host='.$config['host'].';'
                : '';

        $dsn .= ( ! empty($config['database']) )
                ? 'dbname='.$config['database'].';'
                : '';

        $dsn .= ( ! empty($config['port']) )
                ? 'port='.$config['port'] .';'
                : '';

        $dsn .= ( ! empty($config['user']) )
                ? 'user='.$config['user'] .';'
                : '';

        $dsn .= ( ! empty($config['password']) )
                ? 'password='.$config['password']
                : '';

        return rtrim($dsn, ';');
    }
}
