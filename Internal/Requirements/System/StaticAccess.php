<?php namespace ZN\Requirements\System;

class StaticAccess
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
    // Call Static
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    public static function __callStatic($method, $parameters)
    {
        return self::useClassName($method, $parameters);
    }

    //--------------------------------------------------------------------------------------------------------
    // Call
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    public function __call($method, $parameters)
    {
        return self::useClassName($method, $parameters);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Use Class Name
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function useClassName($method, $parameters)
    {
        return uselib(INTERNAL_ACCESS.static::getClassName())->$method(...$parameters);
    }
}

class_alias('ZN\Requirements\System\StaticAccess', 'StaticAccess');
