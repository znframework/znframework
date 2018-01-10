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

class PHP
{
    /**
     * PHP Tag Chars
     * 
     * @var array
     */
    protected static $phpTagChars =
    [
        '<?' => '&#60;&#63;',
        '?>' => '&#63;&#62;'
    ];

    /**
     * Encode PHP Tag
     * 
     * @param string $str
     * 
     * @return string
     */
    public static function encode(String $str) : String
    {
        return str_replace(array_keys(self::$phpTagChars), array_values(self::$phpTagChars), $str);
    }

    /**
     * Decode PHP Tag
     * 
     * @param string $str
     * 
     * @return string
     */
    public static function decode(String $str) : String
    {
        return str_replace(array_values(self::$phpTagChars), array_keys(self::$phpTagChars), $str);
    }

    /**
     * Clean PHP Tag
     * 
     * @param string $str
     * 
     * @return string
     */
    public static function tagClean(String $str) : String
    {
        return str_ireplace(['<?php', '<?', '?>'], NULL, $str);
    }
}
