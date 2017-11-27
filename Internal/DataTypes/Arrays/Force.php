<?php namespace ZN\DataTypes\Arrays;

class Force
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
    // Force Values
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array    $array
    // @param callable $callable
    //
    //--------------------------------------------------------------------------------------------------------
    public static function values(Array $array, Callable $callable) : Array
    {
        return array_map($callable, $array);
    }

    //--------------------------------------------------------------------------------------------------------
    // Force Keys
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array    $array
    // @param callable $callable
    //
    //--------------------------------------------------------------------------------------------------------
    public static function keys(Array $array, Callable $callable) : Array
    {
        $keys = array_map($callable, array_keys($array));

        return array_combine($keys, array_values($array));
    }

    //--------------------------------------------------------------------------------------------------------
    // Force
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array    $array
    // @param callable $callable
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(Array $array, Callable $callable) : Array
    {
        $values = array_values(array_map($callable, $array));
        $keys   = array_values(array_map($callable, array_keys($array)));

        return array_combine($keys, $values);
    }
}
