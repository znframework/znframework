<?php namespace ZN\Security;
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

class Html
{
    /**
     * Encode HTML
     * 
     * @param string $string 
     * @param string $type     = 'quotes'
     * @param string $encoding = 'utf-8'
     * 
     * @return string
     */
    public static function encode(String $string, String $type = 'quotes', String $encoding = 'utf-8') : String
    {
        return htmlspecialchars(trim($string), Converter::toConstant($type, 'ENT_'), $encoding);
    }

    /**
     * Decode HTML
     * 
     * @param string $string 
     * @param string $type     = 'quotes'
     * 
     * @return string
     */
    public static function decode(String $string, String $type = 'quotes') : String
    {
        return htmlspecialchars_decode(trim($string), Converter::toConstant($type, 'ENT_'));
    }

    /**
     * Clean HTML Tag
     * 
     * @param string $string 
     * 
     * @return string
     */
    public static function tagClean(String $string) : String
    {
        return strip_tags($string);
    }
}
