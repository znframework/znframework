<?php namespace ZN\Requirements;

class BaseController
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
    // Get
    //--------------------------------------------------------------------------------------------------------
    // 
    // Magic Get
    //
    //--------------------------------------------------------------------------------------------------------
    public function __get($class)
    {
        if( ! isset($this->$class) )
        {
            return $this->$class = uselib($class);  
        }
    }
}

class_alias('ZN\Requirements\BaseController', 'BaseController');