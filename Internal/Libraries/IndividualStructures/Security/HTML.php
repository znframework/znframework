<?php namespace ZN\IndividualStructures\Security;

use Converter;

class HTML implements HTMLInterface
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
    // Html Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param string $type: quotes, nonquotes, compat
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public function encode(string $string, string $type = 'quotes', string $encoding = 'utf-8') : string
    {
        return htmlspecialchars(trim($string), Converter::toConstant($type, 'ENT_'), $encoding);
    }

    //--------------------------------------------------------------------------------------------------------
    // Html Decode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param string $type: quotes, nonquotes, compat
    //
    //--------------------------------------------------------------------------------------------------------
    public function decode(string $string, string $type = 'quotes') : string
    {
        return htmlspecialchars_decode(trim($string), Converter::toConstant($type, 'ENT_'));
    }

    //--------------------------------------------------------------------------------------------------------
    // HTML Tag Clean
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    //
    //--------------------------------------------------------------------------------------------------------
    public function tagClean(string $string) : string
    {
        return strip_tags($string);
    }
}
