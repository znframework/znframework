<?php namespace ZN;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Coalesce implements CoalesceInterface
{
    /**
     * Null Coalesce
     * 
     * @param mixed & $var
     * @param mixed   $value
     * 
     * @return void
     */
    public static function null( & $var, $value)
    {
        $var = $var ?? $value;
    }

    /**
     * False Coalesce
     * 
     * @param mixed & $var
     * @param mixed   $value
     * 
     * @return void
     */
    public static function false( & $var, $value)
    {
        $var = $var === false ? $value : $var;
    }

    /**
     * Empty Coalesce
     * 
     * @param mixed & $var
     * @param mixed   $value
     * 
     * @return void
     */
    public static function empty( & $var, $value)
    {
        $var = empty($var) ? $value : $var;
    }
}
