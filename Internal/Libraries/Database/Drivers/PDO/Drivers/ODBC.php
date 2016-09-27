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
    
    use DriverTrait;
    
    /******************************************************************************************
    * DNS                                                                                     *
    *******************************************************************************************
    | Bu sürücü için dsn bilgisi oluşturuluyor.                                               |
    ******************************************************************************************/
    public function dsn()
    {
        $dsn  = 'odbc:DRIVER={IBM DB2 ODBC DRIVER}';
            
        $dsn .= ( ! empty($this->config['database']) ) 
                ? ';DATABASE='.$this->config['database'] 
                : '';
                
        $dsn .= ( ! empty($this->config['host']) ) 
                ? ';HOSTNAME='.$this->config['host'] 
                : '';
                
        $dsn .= ( ! empty($this->config['port']) ) 
                ? ';PORT='.$this->config['port'] 
                : '';
                
        $dsn .= ( ! empty($this->config['protocol']) ) 
                ? ';PROTOCOL='.$this->config['protocol'] 
                : ';PROTOCOL=TCPIP';
                
        $dsn .= ( ! empty($this->config['user']) ) 
                ? ';UID='.$this->config['user'] 
                : '';
        
        $dsn .= ( ! empty($this->config['password']) ) 
                ? ';PWD='.$this->config['password'] 
                : '';
    
        return $dsn;
    }   
}