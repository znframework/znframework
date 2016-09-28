<?php namespace ZN\Database\Drivers\PDO\Drivers;

use ZN\Database\Drivers\PDO\DriverInterface;
use ZN\Database\Drivers\PDO\DriverTrait;

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
    
    use DriverTrait;
    
    /******************************************************************************************
    * DNS                                                                                     *
    *******************************************************************************************
    | Bu sürücü için dsn bilgisi oluşturuluyor.                                               |
    ******************************************************************************************/
    public function dsn()
    {
        $dsn  = 'mysql:';
            
        $dsn .= ( ! empty($this->config['host']) ) 
                ? 'host='.$this->config['host'].';' 
                : '';
                
        $dsn .= ( ! empty($this->config['database']) ) 
                ? 'dbname='.$this->config['database'].';'  
                : '';
                
        $dsn .= ( ! empty($this->config['port']) ) 
                ? 'PORT='.$this->config['port'].';'
                : '';
                
        $dsn .= ( ! empty($this->config['charset']) ) 
                ? 'charset='.$this->config['charset'] 
                : '';
        
        return rtrim($dsn, ';');
    }   
}