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

use ZN\Datatype;

class Split
{
    /**
     * Split Upper Case
     * 
     * @param string $string
     * 
     * @return array
     */
    public static function upperCase(String $string) : Array
    {
        return Datatype::splitUpperCase($string);
    }

    /**
     * Apportion
     * 
     * @param string $string
     * @param int    $length = 76
     * @param string $end    = PHP_EOL
     */
    public static function apportion(String $string, Int $length = 76, String $end = PHP_EOL) : String
    {
        $arrayChunk = array_chunk(preg_split("//u", $string, -1, PREG_SPLIT_NO_EMPTY), $length);

        $string = '';

        foreach( $arrayChunk as $chunk )
        {
            $string .= implode('', $chunk) . $end;
        }

        return $string;
    }

    /**
     * Divide
     * 
     * @param string $str       = NULL
     * @param string $separator = '|'
     * @param string $index     = '0'
     */
    public static function divide(String $str = NULL, String $separator = '|', String $index = '0')
    {
        return Datatype::divide($str, $separator, $index);
    }
}
