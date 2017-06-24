<?php namespace ZN\IndividualStructures\Security;

class ForeignChar extends \CLController
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const config = 'ForeignChars:numericalCodes';

    //--------------------------------------------------------------------------------------------------------
    // Foreign Char Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function encode(String $str) : String
    {
        $chars = FOREIGNCHARS_NUMERICALCODES_CONFIG;

        return str_replace(array_keys($chars), array_values($chars), $str);
    }

    //--------------------------------------------------------------------------------------------------------
    // Foreign Char Decode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public function decode(String $str) : String
    {
        $chars = FOREIGNCHARS_NUMERICALCODES_CONFIG;

        return str_replace(array_values($chars), array_keys($chars), $str);
    }
}
