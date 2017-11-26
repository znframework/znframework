<?php namespace ZN\DataTypes\Arrays;

class Column
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
    // Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param mixed   $columnKey
    // @param mixed   $indexKey
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(Array $array, $columnKey = 0, $indexKey = NULL) : Array
    {
        return array_column($array, $columnKey, $indexKey);
    }
}
