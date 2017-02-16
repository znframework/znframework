<?php namespace ZN\Database\Drivers\PDO\Drivers;

use ZN\Database\Drivers\PDO\DriverInterface;
use ZN\Database\Drivers\PDO\DriverTrait;

class PDOSQLiteDriver implements DriverInterface
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
        $dsn = 'sqlite:';

        if( ! empty($config['database']) )
        {
            $dsn .= $config['database'];
        }
        elseif( ! empty($config['host']) )
        {
            $dsn .= $config['host'];
        }
        else
        {
            $dsn .= ':memory:';
        }

        return $dsn;
    }
}
