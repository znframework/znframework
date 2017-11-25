<?php namespace ZN\DataTypes\Arrays;

use Converter;

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
    public function do(Array $array, String $flags = 'string') : Array
    {
        return array_unique($array, Converter::toConstant($flags, 'SORT_'));
    }
}
