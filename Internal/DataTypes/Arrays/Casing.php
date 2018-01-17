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

use ZN\Datatype;

class Casing
{
    /**
     * Case Array
     * 
     * @param array  $array
     * @param string $type   - options[lower|upper|title]
     * @param string $keyval - options[all|key|value]
     * 
     * @return array
     */
    public static function use(Array $array, String $type = 'lower', String $keyval = 'all') : Array
    {
        return Datatype::caseArray($array, $type, $keyval);
    }

    /**
     * Lower Keys
     * 
     * @param array  $array
     * 
     * @return array
     */
    public static function lowerKeys(Array $array) : Array
    {
        return array_change_key_case($array);
    }

    /**
     * Title Keys
     * 
     * @param array  $array
     * 
     * @return array
     */
    public static function titleKeys(Array $array) : Array
    {
        return self::use($array, 'title', 'key');
    }

    /**
     * Upper Keys
     * 
     * @param array  $array
     * 
     * @return array
     */
    public static function upperKeys(Array $array) : Array
    {
        return array_change_key_case($array, CASE_UPPER);
    }

    /**
     * Lower Values
     * 
     * @param array  $array
     * 
     * @return array
     */
    public static function lowerValues(Array $array) : Array
    {
        return self::use($array, 'lower', 'value');
    }

    /**
     * Title Values
     * 
     * @param array  $array
     * 
     * @return array
     */
    public static function titleValues(Array $array) : Array
    {
        return self::use($array, 'title', 'value');
    }

    /**
     * Upper Values
     * 
     * @param array  $array
     * 
     * @return array
     */
    public static function upperValues(Array $array) : Array
    {
        return self::use($array, 'upper', 'value');
    }

    /**
     * All Lower Case
     * 
     * @param array  $array
     * 
     * @return array
     */
    public static function lower(Array $array) : Array
    {
        return self::use($array, 'lower', 'all');
    }

    /**
     * All Title Case
     * 
     * @param array  $array
     * 
     * @return array
     */
    public static function title(Array $array) : Array
    {
        return self::use($array, 'title', 'all');
    }

    /**
     * All Upper Case
     * 
     * @param array  $array
     * 
     * @return array
     */
    public static function upper(Array $array) : Array
    {
        return self::use($array, 'upper', 'all');
    }
}
