<?php
//--------------------------------------------------------------------------------------------------
// Library
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// library()
//--------------------------------------------------------------------------------------------------
//
// @param string $class
// @param string $function
// @param mixed  $parameters
//
// @return callable
//
//--------------------------------------------------------------------------------------------------
function library(String $class, String $function, $parameters = [])
{
    $var = uselib($class);

    if( ! is_array($parameters) )
    {
        $parameters = [$parameters];
    }

    if( is_callable([$var, $function]) )
    {
        return call_user_func_array([$var, $function], $parameters);
    }
    else
    {
        return false;
    }
}

//--------------------------------------------------------------------------------------------------
// uselib()
//--------------------------------------------------------------------------------------------------
//
// @param string $class
// @param array  $parameters
//
// @return class
//
//--------------------------------------------------------------------------------------------------
function uselib(String $class, Array $parameters = [])
{
    if( ! class_exists($class) )
    {
        $classInfo = ZN\Autoloader\Autoloader::getClassFileInfo($class);

        $class = $classInfo['namespace'];

        if( ! class_exists($class) )
        {
            die(getErrorMessage('Error', 'classError', $class));
        }
    }

    if( ! isset(zn::$use->$class) )
    {
        if( ! is_object(zn::$use) )
        {
            zn::$use = new stdClass();
        }

        zn::$use->$class = new $class(...$parameters);
    }

    return zn::$use->$class;
}
