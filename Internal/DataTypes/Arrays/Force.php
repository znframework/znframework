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

class Force
{
    /**
     * Force Values
     * 
     * @param array    $array
     * @param callable $callable
     * 
     * @return array
     */
    public static function values(Array $array, Callable $callable) : Array
    {
        return array_map($callable, $array);
    }

    /**
     * Force Keys
     * 
     * @param array    $array
     * @param callable $callable
     * 
     * @return array
     */
    public static function keys(Array $array, Callable $callable) : Array
    {
        $keys = array_map($callable, array_keys($array));

        return array_combine($keys, array_values($array));
    }

    /**
     * Force All
     * 
     * @param array    $array
     * @param callable $callable
     * 
     * @return array
     */
    public static function do(Array $array, Callable $callable) : Array
    {
        $values = array_values(array_map($callable, $array));
        $keys   = array_values(array_map($callable, array_keys($array)));

        return array_combine($keys, $values);
    }
}
