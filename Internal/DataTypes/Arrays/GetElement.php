<?php namespace ZN\DataTypes\Arrays;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class GetElement
{
    /**
     * Get Last Element
     * 
     * @param array $array
     * @param int   $count       = 1
     * @param bool  $preserveKey = false
     * 
     * @return array
     */
    public static function last(Array $array, Int $count = 1, Bool $preserveKey = false)
    {
        if( $count <= 1 )
        {
            $array = end($array) ?? NULL;
        }
        else
        {
            return array_slice($array, -$count, NULL, $preserveKey);
        }

        return $array;
    }

    /**
     * Get First Element
     * 
     * @param array $array
     * @param int   $count       = 1
     * @param bool  $preserveKey = false
     * 
     * @return array
     */
    public static function first(Array $array, Int $count = 1, Bool $preserveKey = false)
    {
        if( $count <= 1 )
        {
            $array = current($array) ?? NULL;
        }
        else
        {
            return array_slice($array, 0, $count, $preserveKey);
        }

        return $array;
    }
}
