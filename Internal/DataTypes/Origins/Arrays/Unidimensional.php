<?php namespace ZN\DataTypes\Arrays;

use RecursiveIteratorIterator, RecursiveArrayIterator;

class Unidimensional
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
    // Unidimensional -> 5.4.5[added]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param bool  $preserveKey = true
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(Array $array, Bool $preserveKey = true) : Array
    {
        return iterator_to_array
        (
            new RecursiveIteratorIterator
            (
                new RecursiveArrayIterator($array)
            ), 
   
            $preserveKey
        );
    }
}
