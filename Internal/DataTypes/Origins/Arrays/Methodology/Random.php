<?php namespace ZN\DataTypes\Arrays;

class Random
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
    // Random
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param numeric $countRequest
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(Array $array, Int $countRequest = 1)
    {
        return array_rand($array, $countRequest);
    }
}
