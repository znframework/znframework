<?php namespace ZN\DataTypes\Arrays;

class GetElement
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
    // Get Last
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param numeric $count
    // @param bool    $preserveKey
    //
    //--------------------------------------------------------------------------------------------------------
    public static function last(Array $array, Int $count = 1, Bool $preserveKey = false)
    {
        if( $count <= 1 )
        {
            $array = end($array) ?? NULL;
        }
        else
        {
            return array_slice($array, -$count, NULL, $preserveKey);
        }

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Get First
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param numeric $count
    // @param bool    $preserveKey
    //
    //--------------------------------------------------------------------------------------------------------
    public static function first(Array $array, Int $count = 1, Bool $preserveKey = false)
    {
        if( $count <= 1 )
        {
            $array = current($array) ?? NULL;
        }
        else
        {
            return array_slice($array, 0, $count, $preserveKey);
        }

        return $array;
    }
}
