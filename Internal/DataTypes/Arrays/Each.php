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

class Each
{
    /**
     * Each
     * 
     * @param array    $array
     * @param callable $callable
     */
    public static function use(Array $array, Callable $callable)
    {
        foreach( $array as $k => $v )
        {
            $callable($v, $k);
        }
    }
}
