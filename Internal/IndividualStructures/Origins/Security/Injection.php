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

class Injection
{
    //--------------------------------------------------------------------------------------------------------
    // Nail Chars
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected static $nailChars =
    [
        "'" => "&#39;",
        '"' => "&#34;"
    ];

    //--------------------------------------------------------------------------------------------------------
    // Injection Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    //
    //--------------------------------------------------------------------------------------------------------
    public static function encode(String $string) : String
    {
        $secBadChars = Properties::$injectionBadChars;

        if( ! empty($secBadChars) )
        {
            foreach( $secBadChars as $badChar => $changeChar )
            {
                if( is_numeric($badChar) )
                {
                    $badChar = $changeChar;
                    $changeChar = '';
                }

                $badChar = trim($badChar, '/');
                $string  = preg_replace('/'.$badChar.'/xi', $changeChar, $string);
            }
        }

        return addslashes(trim($string));
    }

    //--------------------------------------------------------------------------------------------------------
    // Injection Decode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $string
    //
    //--------------------------------------------------------------------------------------------------------
    public static function decode(String $string) : String
    {
        return stripslashes(trim($string));
    }

    //--------------------------------------------------------------------------------------------------------
    // Nail Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public static function nailEncode(String $str) : String
    {
        $str = str_replace(array_keys(self::$nailChars), array_values(self::$nailChars), $str);

        return $str;
    }

    //--------------------------------------------------------------------------------------------------------
    // Nail Decode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public static function nailDecode(String $str) : String
    {
        $str = str_replace(array_values(self::$nailChars), array_keys(self::$nailChars), $str);

        return $str;
    }

    //--------------------------------------------------------------------------------------------------------
    // Escape String Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public static function escapeStringEncode(String $data) : String
    {
        return addslashes($data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Escape String Decode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    //
    //--------------------------------------------------------------------------------------------------------
    public static function escapeStringDecode(String $data) : String
    {
        return stripslashes($data);
    }
}
