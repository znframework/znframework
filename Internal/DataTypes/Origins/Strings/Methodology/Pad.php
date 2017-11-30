<?php namespace ZN\DataTypes\Strings;

use ZN\Helpers\Converter;

class Pad
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
    // Pad
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param numeric $count
    // @param string  $chars
    // @param string  $type
    //
    //--------------------------------------------------------------------------------------------------------
    public static function use(String $string, Int $count = 1, String $chars = ' ', String $type = 'right') : String
    {
        return str_pad($string, $count, $chars, Converter::toConstant($type, 'STR_PAD_'));
    }
}
