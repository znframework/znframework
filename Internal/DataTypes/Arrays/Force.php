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
        return Map::do($callable, $array);
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
        $keys = Map::do($callable, Element::keys($array));

        return Combine::do($keys, Element::values($array));
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
        $values = Element::values(Map::do($callable, $array));
        $keys   = Element::values(Map::do($callable, Element::keys($array)));

        return Combine::do($keys, $values);
    }
}
