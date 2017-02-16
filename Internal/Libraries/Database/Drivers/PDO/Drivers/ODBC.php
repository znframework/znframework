<?php namespace ZN\Database\Drivers\PDO\Drivers;

use ZN\Database\Drivers\PDO\DriverInterface;
use ZN\Database\Drivers\PDO\DriverTrait;

class PDOODBCDriver implements DriverInterface
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
        $dsn  = 'odbc:DRIVER={IBM DB2 ODBC DRIVER}';

        $dsn .= ( ! empty($config['database']) )
                ? ';DATABASE='.$config['database']
                : '';

        $dsn .= ( ! empty($config['host']) )
                ? ';HOSTNAME='.$config['host']
                : '';

        $dsn .= ( ! empty($config['port']) )
                ? ';PORT='.$config['port']
                : '';

        $dsn .= ( ! empty($config['protocol']) )
                ? ';PROTOCOL='.$config['protocol']
                : ';PROTOCOL=TCPIP';

        $dsn .= ( ! empty($config['user']) )
                ? ';UID='.$config['user']
                : '';

        $dsn .= ( ! empty($config['password']) )
                ? ';PWD='.$config['password']
                : '';

        return $dsn;
    }
}
