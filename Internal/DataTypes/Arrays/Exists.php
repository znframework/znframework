<?php namespace ZN\DataTypes\Arrays;

class Exists
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
    // Value Exists
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $element
    // @param bool  $strict
    //
    //--------------------------------------------------------------------------------------------------------
    public static function value(Array $array, $element, Bool $strict = false) : Bool
    {
        return in_array($element, $array, $strict);
    }

    //--------------------------------------------------------------------------------------------------------
    // Value Exists Insensitive
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $element
    // @param bool  $insenstive
    //
    //--------------------------------------------------------------------------------------------------------
    public static function valueInsensitive(Array $array, $element, Bool $strict = false) : Bool
    {
        return self::value(array_map('strtolower', $array), strtolower($element), $strict);
    }

    //--------------------------------------------------------------------------------------------------------
    // Key Exists
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $key
    //
    //--------------------------------------------------------------------------------------------------------
    public static function key(Array $array, $key) : Bool
    {
        return array_key_exists($key, $array);
    }

    //--------------------------------------------------------------------------------------------------------
    // Key Exists Insensitive
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $key
    //
    //--------------------------------------------------------------------------------------------------------
    public static function keyInsensitive(Array $array, $key) : Bool
    {
        return self::key(array_change_key_case($array), strtolower($key));
    }
}
