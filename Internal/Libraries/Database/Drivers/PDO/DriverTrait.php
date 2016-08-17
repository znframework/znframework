<?php namespace ZN\Database\Drivers\PDO;

trait DriverTrait
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------
    
    //--------------------------------------------------------------------------------------------------------
    // Config
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $config;
    
    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        $this->config = \Config::get('Database', 'database');   
    }
}