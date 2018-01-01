<?php namespace ZN\IndividualStructures\Security;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Helpers\Converter;

class HTML
{
    //--------------------------------------------------------------------------------------------------------
    // Html Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    // @param string $type: quotes, nonquotes, compat
    // @param string $encoding
    //
    //--------------------------------------------------------------------------------------------------------
    public static function encode(String $string, String $type = 'quotes', String $encoding = 'utf-8') : String
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
    public static function decode(String $string, String $type = 'quotes') : String
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
    public static function tagClean(String $string) : String
    {
        return strip_tags($string);
    }
}
