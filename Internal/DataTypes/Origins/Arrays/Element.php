<?php namespace ZN\DataTypes\Arrays;

use ZN\DataTypes\Exception\InvalidArgumentException;

class Element
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
    // Keyval
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $keyval: val/value, key, vals/values, keys
    //
    //--------------------------------------------------------------------------------------------------------
    public static function use(Array $array, String $keyval = 'value')
    {
        switch( $keyval )
        {
            case 'value'  : return current($array);
            case 'key'    : return key($array);
            case 'values' : return array_values($array);
            case 'keys'   : return array_keys($array);
            default       : throw new InvalidArgumentException
            (
                '[Arrays::keyval()], 2.($keyval) parameter is invalid! [Available Options:] value, key, values, keys'
            );
        }
    }
}
