<?php namespace ZN\Database\Drivers\PDO\Drivers;

use ZN\Database\Drivers\PDO\DriverInterface;

class PDOMySQLDriver implements DriverInterface
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
        $dsn  = 'mysql:';

        $dsn .= ( ! empty($config['host']) )
                ? 'host='.$config['host'].';'
                : '';

        $dsn .= ( ! empty($config['database']) )
                ? 'dbname='.$config['database'].';'
                : '';

        $dsn .= ( ! empty($config['port']) )
                ? 'PORT='.$config['port'].';'
                : '';

        $dsn .= ( ! empty($config['charset']) )
                ? 'charset='.$config['charset']
                : '';

        return rtrim($dsn, ';');
    }
}
