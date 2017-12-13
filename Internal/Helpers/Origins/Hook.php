<?php namespace ZN\Helpers;

class Hook
{
    //--------------------------------------------------------------------------------------------------------
    // Hook -> 5.3.6
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public function __call($method, $parameters)
    {
        $hook = \Config::hooks();

        return $hook[$method](...$parameters) ?? false;
    }
}
