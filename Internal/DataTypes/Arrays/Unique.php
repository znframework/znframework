<?php namespace ZN\DataTypes\Arrays;

use ZN\Helpers\Converter\VariableTypes;

class Unique
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
    // Delete Recurrent
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $flags
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(Array $array, String $flags = 'string') : Array
    {
        return array_unique($array, VariableTypes::toConstant($flags, 'SORT_'));
    }
}
