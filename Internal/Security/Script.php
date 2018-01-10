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

class Script
{
    /**
     * Script Tag Chars
     * 
     * @var array
     */
    protected static $scriptTagChars =
    [
        '/\<script(.*?)\>/i'  => '&#60;script$1&#62;',
        '/\<\/script\>/i'     => '&#60;/script&#62;'
    ];

    /**
     * Script Tag Chars Decode
     * 
     * @var array
     */
    protected static $scriptTagCharsDecode =
    [
        '/\&\#60\;script(.*?)\&\#62\;/i' => '<script$1>',
        '/\&\#60\;\/script\&\#62\;/i'    => '</script>'
    ];

    /**
     * Encode Script Tags
     * 
     * @param string $str
     * 
     * @return string
     */
    public static function encode(String $str) : String
    {
        return preg_replace
        (
            array_keys(self::$scriptTagChars), 
            array_values(self::$scriptTagChars), 
            $str
        );
    }

    /**
     * Decode Script Tags
     * 
     * @param string $str
     * 
     * @return string
     */
    public static function decode(String $str) : String
    {
        return preg_replace
        (
            array_keys(self::$scriptTagCharsDecode), 
            array_values(self::$scriptTagCharsDecode), 
            $str
        );
    }
}
