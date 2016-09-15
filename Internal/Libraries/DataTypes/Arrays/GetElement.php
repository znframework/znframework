<?php namespace ZN\DataTypes\Arrays;

class GetElement implements GetElementInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
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
    public function getLast(Array $array, Int $count = 1, Bool $preserveKey = false)
    {
        if( $count <= 1 )
        {
            $array = end($array);
        }
        else
        {
            return $this->section($array, -$count, NULL, $preserveKey);
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
    public function getFirst(Array $array, Int $count = 1, Bool $preserveKey = false)
    {
        if( $count <= 1 )
        {
            $array = $array[0];
        }
        else
        {
            return $this->section($array, 0, $count, $preserveKey);
        }

        return $array;
    }
}
