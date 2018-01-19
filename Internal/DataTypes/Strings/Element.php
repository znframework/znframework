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

class Element
{
    /**
     * Remove First Element
     * 
     * @param string $str
     * @param string $separator = '/'
     * @param int    $index     = 0
     * 
     * @return string
     */
    public static function removeFirst(String $str, String $separator = '/', Int $index = 0) : String
    {
        return self::remove($str, $separator, abs($index));
    }

    /**
     * Remove Last Element
     * 
     * @param string $str
     * @param string $separator = '/'
     * @param int    $index     = 0
     * 
     * @return string
     */
    public static function removeLast(String $str, String $separator = '/', Int $index = 0) : String
    {
        return self::remove($str, $separator, -abs($index));
    }

    /**
     * Remove Element
     * 
     * @param string $str
     * @param string $separator = '/'
     * @param int    $index     = 0
     * 
     * @return string
     */
    public static function remove(String $str, String $separator = '/', Int $index = 0) : String
    {
        $strEx = explode($separator, $str);

        if( ($countStr = count($strEx)) === 1 ) return $str;

        $count = abs($index);

        if( $countStr < $count ) $count = $countStr;
   
        if( $count > 0 ) for( $start = 1; $start <= $count; $start++ )
        {
           ($index < 0 ? 'array_pop' : 'array_shift')($strEx);
        }

        return implode($separator, $strEx);
    }
}
