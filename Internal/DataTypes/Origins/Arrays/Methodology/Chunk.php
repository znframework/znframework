<?php namespace ZN\DataTypes\Arrays;

class Chunk
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
    // Apportion
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param numeric $portionCount
    // @param bool    $preserveKeys
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(Array $data, Int $portionCount = 1, Bool $preserveKeys = false) : Array
    {
        return array_chunk($data, $portionCount, $preserveKeys);
    }
}
