<?php namespace ZN\Database\Drivers\PDO\Drivers;

use ZN\Database\Drivers\PDO\DriverInterface;

class PDOSQLServerDriver implements DriverInterface
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
        $dsn  = 'sqlsrv:Server=';

        if( ! empty($config['server']) )
        {
            $dsn .= $config['server'];
        }
        elseif( ! empty($config['host']) )
        {
            $dsn .= $config['server'];
        }
        else
        {
            $dsn .= '127.0.0.1';
        }

        $dsn .= ( ! empty($config['port']) )
                ? ','.$config['port']
                : '';

        $dsn .= ( ! empty($config['database']))
                ? ';Database='.$config['database']
                : '';

        return $dsn;
    }
}
