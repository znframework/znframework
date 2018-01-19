<?php namespace ZN\DataTypes\Strings;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Helper;

class Casing
{
    /**
     * Casing
     * 
     * @param string $str
     * @param string $type     = 'lower'
     * @param string $encoding = 'utf-8'
     * 
     * @return string
     */
    public static function use(String $str, String $type = 'lower', String $encoding = 'utf-8') : String
    {
        return mb_convert_case($str, Helper::toConstant($type, 'MB_CASE_'), $encoding);
    }

    /**
     * Upper
     * 
     * @param string $str
     * @param string $encoding = 'utf-8'
     * 
     * @return string
     */
    public static function upper(String $str, String $encoding = 'utf-8') : String
    {
        return self::use($str, __FUNCTION__, $encoding);
    }

    /**
     * Lower
     * 
     * @param string $str
     * @param string $encoding = 'utf-8'
     * 
     * @return string
     */
    public static function lower(String $str, String $encoding = 'utf-8') : String
    {
        return self::use($str, __FUNCTION__, $encoding);
    }

    /**
     * Title
     * 
     * @param string $str
     * @param string $encoding = 'utf-8'
     * 
     * @return string
     */
    public static function title(String $str, String $encoding = 'utf-8') : String
    {
        return self::use($str, __FUNCTION__, $encoding);
    }

    /**
     * Camel
     * 
     * @param string $str
     * 
     * @return string
     */
    public static function camel(String $str) : String
    {
        $string = self::title(trim($str));

        $string[0] = self::lower($string);

        return Trim::middle($string);
    }

    /**
     * Pascal
     * 
     * @param string $str
     * 
     * @return string
     */
    public static function pascal(String $str) : String
    {
        $string = self::title(trim($str));

        return Trim::middle($string);
    }

    /**
     * Underscore
     * 
     * @param string $str
     * 
     * @return string
     */
    public static function underscore(String $str) : String
    {
        if( ! ctype_lower($str) )
        {
            $newstr = NULL;

            for( $i = 0; $i < strlen($str); $i++ )
            {
                if( ctype_upper($str[$i]) )
                {
                    $newstr .= '_' . strtolower($str[$i]);
                }
                else
                {
                    $newstr .= $str[$i];
                }
            }

            $str = $newstr;
        }

        return preg_replace('/\s+/', '\_', $str);
    }
}
