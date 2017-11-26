<?php namespace ZN\DataTypes\Arrays;

class Section
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
    // Section
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param numeric $start
    // @param numeric $length
    // @param bool    $preserveKey
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(Array $array, Int $start = 0, Int $length = NULL, Bool $preserveKeys = false) : Array
    {
        return array_slice($array, $start, $length, $preserveKeys);
    }

    //--------------------------------------------------------------------------------------------------------
    // Resection
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param numeric $start
    // @param numeric $length
    // @param mixed   $newElement
    //
    //--------------------------------------------------------------------------------------------------------
    public static function resection(Array $array, Int $start = 0, Int $length = NULL, $newElement = NULL) : Array
    {
        array_splice($array, $start, $length, $newElement);

        return $array;
    }
}
