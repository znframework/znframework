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

class Search
{
    /**
     * Search 
     * 
     * @param string $str
     * @param string $needle
     * @param string $type = 'string' - options[string|position]
     * @param bool   $case = true
     */
    public static function use(String $str, String $needle, String $type = 'string', Bool $case = true)
    {
        if( $type === 'string' )
        {
            if( $case === true )
            {
                $function = 'mb_strstr';
            }
            else
            {
                $function = 'mb_stristr';
            }

            return $function($str, $needle);
        }

        if( $type === 'position' )
        {
            if( $case === true )
            {
                $function = 'mb_strpos';
            }
            else
            {
                $function = 'mb_stripos';
            }

            return $function($str, $needle);
        }
    }

    /**
     * Search Position 
     * 
     * @param string $str
     * @param string $needle
     * @param bool   $case = true
     */
    public static function position(String $str, String $needle, Bool $case = true)
    {
        return self::use($str, $needle, __FUNCTION__, $case);
    }

    /**
     * Search String 
     * 
     * @param string $str
     * @param string $needle
     * @param bool   $case = true
     */
    public static function string(String $str, String $needle, Bool $case = true) : String
    {
        return self::use($str, $needle, __FUNCTION__, $case);
    }
}
