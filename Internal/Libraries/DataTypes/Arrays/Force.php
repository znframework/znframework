<?php namespace ZN\DataTypes\Arrays;

use Arrays;

class Force implements ForceInterface
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
    public function values(Array $array, Callable $callable) : Array
    {
        return Arrays::map($callable, $array);
    }

    //--------------------------------------------------------------------------------------------------------
    // Force Keys
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array    $array
    // @param callable $callable
    //
    //--------------------------------------------------------------------------------------------------------
    public function keys(Array $array, Callable $callable) : Array
    {
        $keys = Arrays::map($callable, Arrays::keys($array));

        return Arrays::combine($keys, Arrays::values($array));
    }

    //--------------------------------------------------------------------------------------------------------
    // Force
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array    $array
    // @param callable $callable
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(Array $array, Callable $callable) : Array
    {
        $values = Arrays::values(Arrays::map($callable, $array));
        $keys   = Arrays::values(Arrays::map($callable, Arrays::keys($array)));

        return Arrays::combine($keys, $values);
    }
}
